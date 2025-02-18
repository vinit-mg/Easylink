<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\IntegrationServiceResolver;
use App\Services\FeatureService;
use App\Http\Classes\CustomerStore;
use App\Jobs\OrderTransferJob;
use App\Models\Schedulers;

class OrdersController extends Controller
{
    protected IntegrationServiceResolver $resolver;
    protected FeatureService $featureService;
    protected CustomerStore $customerStore;

    public function __construct(IntegrationServiceResolver $resolver, FeatureService $featureService)
    {
        $this->resolver = $resolver;
        $this->featureService = $featureService;
    }

    private function getCommonData(): array
    {   

        $this->customerStore = new CustomerStore();
        
        $store = $this->customerStore->getCurrentStore();
        $customer = $this->customerStore->getCurrentCustomer();
        $activeSubscription = $customer->subscriptions()
            ->where('status', 'active')
            ->latest('start_date')
            ->first();

        if (!$activeSubscription) {
            abort(response()->json(['error' => 'No active subscription found for the customer'], 400));
        }

        return [
            'store' => $store,
            'customer' => $customer,
            'activeSubscription' => $activeSubscription,
            'source' => $store->source->name,
            'destination' => $store->destination->name,
        ];
    }

    public function index(Request $request)
    {
        try {
            $data = $this->getCommonData();
           
            extract($data);

            $Scheduler = Schedulers::find(1);
            OrderTransferJob::dispatch($store, $Scheduler);

            if (!$store->hasPermission('List Orders')) {
                return response()->json(['error' => 'This store has no permissions to view orders'], 400);
            }

            $options = [
                'current_page_no' => $request->input('page', ''),
                'cursor_position' => $request->input('rel', 'after'),
                'order_number' => $request->input('search'),
                'rows_per_page' => 20,
                'features' => $this->featureService->getFeaturesForSubscription($customer)
            ];

            $service = $this->resolver->resolveService($source, $destination, 'Orders', 'Get');
            $response = $service->execute($store, $activeSubscription, $options);
          
            $templatePath = $this->customerStore->getTemplatePath($source, $destination, 'Orders', 'index');

            return view($templatePath, compact('response', 'store', 'options'));

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function view(Request $request)
    {
        try {
            $data = $this->getCommonData();
            extract($data);
            
            if (!$store->hasPermission('View Order')) {
                return response()->json(['error' => 'This store has no permissions to view orders'], 400);
            }

            $options = [
                'features' => $this->featureService->getFeaturesForSubscription($customer)
            ];
          
            $service = $this->resolver->resolveService($source, $destination, 'Orders', 'View');
            $response = $service->execute($request, $store, $activeSubscription, $options);
            $template = 'view';
            if($response['error'])
                $template = 'error';
            $templatePath = $this->customerStore->getTemplatePath($source, $destination, 'Orders', $template);

            return view($templatePath, compact('response', 'store', 'options'));

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function transfer(Request $request)
    {
        try {
            $data = $this->getCommonData();
            extract($data);

            if (!$store->hasPermission('Order Transfer Manually')) {
                return response()->json(['error' => 'This store has no permissions to transfer orders manually'], 400);
            }

            $options = [
                'features' => $this->featureService->getFeaturesForSubscription($activeSubscription)
            ];

            $service = $this->resolver->resolveService($source, $destination, 'Orders', 'Transfer');
            
            $response =  $service->execute($request->id, $store, $activeSubscription, $options);
          
            if($response['error'])
                $this->customerStore->getTemplatePath($source, $destination, 'Orders', 'error');
       
            return redirect()->route('orders.view', $request->id)
                        ->with('message', 'Order Transfred successfully.');

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}