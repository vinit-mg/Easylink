<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stores;
use App\Models\Destination;
use App\Models\Source;
use App\Models\Customers;
use App\Models\Auth;
use App\Models\DynamicFields;
use App\Models\StoreSettings;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Events\StoreActivated;
use App\Events\StoreDeactivated;
use App\Models\AddOnFeatures;
use Symfony\Component\Process\Process;
use App\Models\StorePermission;
use App\Services\AddOnServiceLoader;

use Illuminate\Support\Str;

class StoreController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(){

        $this->authorize('adminViewAny', Stores::class);

        $Stores = (new Stores)->newQuery();

        if (request()->has('search')) {
            $Stores->where('StoreName', 'Like', '%'.request()->input('search').'%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $Stores->orderBy($attribute, $sort_order);
        } else {
            $Stores->latest();
        }

        $stores = $Stores->paginate(5)->onEachSide(2);
  
        return view('admin.Store.index',compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Customers $customer) {

        $this->authorize('adminCreate', Stores::class);

        $destinations = (new Destination())->newQuery()->get();
        $sources = (new Source())->newQuery()->get();
        $customers = (new Customers())->newQuery()->get();
        return view('admin.Store.create',compact('destinations','sources','customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreStoreRequest $request, Customers $customer){

        $this->authorize('adminCreate', Stores::class);

        // Create source auth
        $sourceAuth = Auth::create([
            'type' => $request->source_auth_type,
            'username' => $request->source_username,
            'password' => $request->source_password,
            'token' => $request->source_token,
            'api_key' => $request->source_api_key,
            'client_id' => $request->source_client_id,
            'client_secret' => $request->source_client_secret,
            'api_url' => $request->source_api_url,
            'additional_info' => $request->source_additional_info,
            'requires_dynamic_url' => ($request->source == 1) ? true : false,
        ]);

        if($sourceAuth->requires_dynamic_url){
            
            DynamicFields::create([
                'AuthId' =>  $sourceAuth->id,
                'source_id' => $request->source,
                'field_name' => ($request->source == 1) ? 'shopifyapiversion' : '',
                'field_value' => $request->shopifyapiversion,
            ]);
        }

        // Create destination auth
        $destinationAuth = Auth::create([
            'type' => $request->destination_auth_type,
            'username' => $request->destination_username,
            'password' => $request->destination_password,
            'token' => $request->destination_token,
            'api_key' => $request->destination_api_key,
            'client_id' => $request->destination_client_id,
            'client_secret' => $request->destination_client_secret,
            'api_url' => $request->destination_api_url,
            'additional_info' => $request->destination_additional_info,
            'requires_dynamic_url' => ($request->destination == 1) ? true : false,
        ]);

        if($destinationAuth->requires_dynamic_url){
            
            DynamicFields::create([
                'AuthId' =>  $destinationAuth->id,
                'destination_id' => $request->destination,
                'field_name' => ($request->destination == 1) ? 'ackrocustomer' : '',
                'field_value' => $request->ackrocustomer,
            ]);
        }

        // Create store
        Stores::create([
            'name' => $request->name,
            'customer_id' => $customer->id,
            'source_id' => $request->source,
            'destination_id' => $request->destination,
            'source_auth_id' => $sourceAuth->id,
            'destination_auth_id' => $destinationAuth->id,
        ]);

        return redirect()->route('admin.customers.show', $customer->uuid)
            ->with('message', 'Store created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Stores  $store
     * @return \Illuminate\View\View
     */
    public function edit(Customers $customer, Stores $store) {

        $this->authorize('adminUpdate', Stores::class);

        $destinations = Destination::get();
        $sources = Source::get();
        $customers = Customers::get();
        return view('admin.Store.edit',compact('store','destinations','sources','customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateStoreRequest  $request
     * @param  \Models\Stores  $stores
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateStoreRequest $request, Customers $customer, Stores $store){

        $this->authorize('adminUpdate', Stores::class);


        // Create source auth
        $sourceAuth = $store->source_auth->update([
            'type' => $request->source_auth_type,
            'username' => $request->source_username,
            'password' => $request->source_password,
            'token' => $request->source_token,
            'api_key' => $request->source_api_key,
            'client_id' => $request->source_client_id,
            'client_secret' => $request->source_client_secret,
            'api_url' => $request->source_api_url,
            'additional_info' => $request->source_additional_info,
            'requires_dynamic_url' => ($request->source == 1) ? true : false,
        ]);

        if($store->source_auth->requires_dynamic_url){
            $store->source_auth->DynamicFields()->where('field_name', 'shopifyapiversion')->update([
                'AuthId' =>  $store->source_auth->id,
                'source_id' => $request->source,
                'field_name' => ($request->source == 1) ? 'shopifyapiversion' : '',
                'field_value' => $request->shopifyapiversion,
            ]);
        }

        // Create destination auth
        $destinationAuth = $store->destination_auth->update([
            'type' => $request->destination_auth_type,
            'username' => $request->destination_username,
            'password' => $request->destination_password,
            'token' => $request->destination_token,
            'api_key' => $request->destination_api_key,
            'client_id' => $request->destination_client_id,
            'client_secret' => $request->destination_client_secret,
            'api_url' => $request->destination_api_url,
            'additional_info' => $request->destination_additional_info,
            'requires_dynamic_url' => ($request->destination == 1) ? true : false,
        ]);

        if($store->destination_auth->requires_dynamic_url){
            
            $store->destination_auth->DynamicFields()->where('field_name', 'ackrocustomer')->update([
                'destination_id' => $request->destination,
                'AuthId' =>  $store->destination_auth->id,
                'field_name' => ($request->destination == 1) ? 'ackrocustomer' : '',
                'field_value' => $request->ackrocustomer,
            ]);
        }

        // Create store
        $store->update([
            'name' => $request->name,
            'customer_id' => $customer->id,
            'source_id' => $request->source,
            'destination_id' => $request->destination,
            'source_auth_id' => $store->source_auth->id,
            'destination_auth_id' => $store->destination_auth->id,
        ]);
        
        $store->update($request->all());

        return redirect()->route('admin.customers.show', $customer->uuid)
                        ->with('message', 'Store updated successfully.');
    }

    public function manage(Customers $customer, Stores $store){

        $features = $store->customer->ActiveSubscription->package->getFeaturesForSourceAndDestination($store->source_id, $store->destination_id);
        $storeProcesses = $this->supervisorProccess($store);
        
        return view('admin.Store.managesettings', compact('store', 'features', 'customer', 'storeProcesses'));
    }

    public function saveSettings(Request $request, Customers $customer, Stores $store){
        
        $formFields = $request->except(['_token']); // Exclude the CSRF token if present
        
        foreach ($formFields as $key => $value) {
            // Check if the value is an array; if so, convert it to JSON
            $metaValue = is_array($value) ? json_encode($value) : $value;

            StoreSettings::updateOrCreate(
                [
                    'store_id' => $store->id,
                    'meta_key' => $key,
                ],
                [
                    'meta_value' => $metaValue,
                ]
            );
        }

        return redirect()->route('admin.customer.stores.manage', $customer->uuid)
         ->with('message', __('Settings saved successfully!'));
    }
    public function loadAddOns(Customers $customer, Stores $store, AddOnFeatures $feature){

        $store = Stores::findOrFail($store->id);
    
        $AddOnFeature = AddOnFeatures::findOrFail($feature->id);

        switch($AddOnFeature->name){
            case 'Shipping method':
                $entity = 'ShippingMethods';
                break;
            default:
                $entity = 'defaultservice';
                break;
        }

        $AddOnServiceLoader = new AddOnServiceLoader();
        
        $addon = $AddOnServiceLoader->resolveService($store->source->name, $store->destination->name, $entity, 'view');
        
        return $addon->execute($customer, $store, $AddOnFeature);
    }

    public function savePermissions(Request $request,Customers $customer, Stores $store){
        
        $formFields = $request->except(['_token']); // Exclude the CSRF token if present
        
        if(isset($formFields['store_permissions'])){
            StorePermission::where('store_id', $store->id)->delete();
            foreach ($formFields['store_permissions'] as $store_permission) {
                StorePermission::create([
                    "store_id" => $store->id,
                    "package_featurte_id" => $store_permission,
                ]);
            }
        }
        

        return redirect()->route('admin.customer.stores.manage', [$customer->uuid, $store->uuid])
         ->with('message', __('Permissions saved successfully!'));
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Stores  $stores
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Customers $customer, Stores $store){

        $this->authorize('adminDelete', Stores::class);
        $store->delete();

        return redirect()->route('admin.customers.show', $customer->uuid)
                        ->with('message', __('Store deleted successfully'));
    }

    public function activateStore(Customers $customer, Stores $store){

        // dd($customer);
        $store->activate();
        // Fire the event
        StoreActivated::dispatch($customer, $store);

        return response()->json(['message' => "Store {$store->uuid} activated successfully."]);

    }  
    public function deactivateStore(Customers $customer, Stores $store){

        $store->deactivate();

        // Fire the event
        StoreDeactivated::dispatch($customer, $store);

        return response()->json(['message' => "Store {$store->uuid} deactivated successfully."]);

    }
    


    /**
     * Test the api credentials
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
    */
    public function test(Request $request){
        $response = null;
       
        switch ($request->auth_type) {
            case 'basic':
                $response = Http::withBasicAuth($request->username, $request->password)
                                ->get($request->api_url);
                break;

            case 'bearer':
                $response = Http::withToken($request->token)
                                ->get($request->api_url);
                break;

            case 'source_api_key':
            case 'destination_api_key':
               
                if($request->shopifyapiversion){
                    $url = "https://{$request->apiurl}/admin/api/{$request->shopifyapiversion}/shop.json";
                    $header = 'X-Shopify-Access-Token';
                } else {
                    $url = $request->apiurl;
                    $header = 'x-api-key';
                }
               
                $response = Http::withHeaders([
                    $header => $request->apiKey
                ])->get($url);
                
                break;

            case 'ntlm':

                $response = Http::withOptions([
                    'auth' => [$request->username, $request->password, 'ntlm']
                ])->get($request->api_url);
                break;

            default:
                return back()->with('error', 'Unsupported authentication type.');
        }

        return $response->successful() ? ['body' => $response->body(),'status' => $response->status() ] : ['status' => $response->status()];
    }

    /**
     * Get the customer name from ackro
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
    */
    public function getAckroCompanyName(Request $request){
        $apiKey = $request->input('apiKey');
        $apiurl = $request->input('apiurl');
   
        $response = Http::withHeaders([
            'x-api-key' =>$apiKey,
        ])->get($apiurl);


        if ($response->successful()) {
            return [
                'body' => $response->body()
            ];
        } else {
            return [
                'error' => $response->body()
            ];
        }
        throw new \Exception('Unable to fetch customer name from Ackro');
    }

     /**
     * Get the shopify versions
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
    */
    public function getShopifyApiVersion(Request $request){
        $apiKey = $request->input('apiKey');
        $apiurl = $request->input('apiurl');
   
        $url = "https://{$apiurl}/admin/api/graphql.json";

        $query = <<<GRAPHQL
        {
            publicApiVersions {
                handle
                displayName
                supported
            }
        }
        GRAPHQL;

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-Shopify-Access-Token' => $apiKey,
            ])->post($url, ['query' => $query]);

            if ($response->successful()) {
                return [
                    'body' => $response->json()['data']['publicApiVersions']
                ];
            } else {
                return [
                    'error' => $response->body()
                ];
            }
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }

    private function supervisorProccess(Stores $store)
    {
        $process = new Process(['sudo', '/usr/bin/supervisorctl', 'status']);
        $process->run();

        $output = explode("\n", trim($process->getOutput()));
      
        $storeProcesses = [];

        foreach ($output as $line) {
            $parts = preg_split('/\s+/', $line, 3);
            
            if (count($parts) >= 2) {
               
                // Extract process name (e.g., store_1_orders, store_2_inventory)
                $processName = $parts[0];

                // Match only processes related to the given store ID
                if (Str::contains($processName, "store_{$store->id}_")) {
                    
                    $storeProcesses[] = [
                        'name' => $processName,
                        'status' => $parts[1],
                        'details' => $parts[2] ?? '',
                    ];
                }
            }
        }

        return $storeProcesses;
    }

}
