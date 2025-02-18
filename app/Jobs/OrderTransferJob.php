<?php

namespace App\Jobs;

use App\Models\Stores;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


use App\Services\IntegrationServiceResolver;
use App\Services\FeatureService;
use App\Http\Classes\CustomerStore;

class OrderTransferJob //implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $store;

    public function __construct(Stores $store)
    {
        $this->store = $store;
    }

    /**
     * Execute the job.
     */
    public function handle(IntegrationServiceResolver $resolver, FeatureService $featureService): void
    {
        Log::info("Running Order Transfer for store: {$this->store->name}");
       
        $customer = $this->store->customer;

        $ActiveSubscription = $this->store->customer->ActiveSubscription;

        if (!$ActiveSubscription) {
            Log::error("No active subscription found for customer {$customer->id}");
            return;
        }

        $options = [
            'features' => $featureService->getFeaturesForSubscription($customer),
        ];
      
        $service = $resolver->resolveService($this->store->source->name, $this->store->destination->name, 'Orders', 'Sync');
        
        $response =  $service->execute($this->store, $options);
       

    }
}
