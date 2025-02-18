<?php

namespace App\Jobs;

use App\Models\Stores;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon; // Added Carbon import

use App\Services\IntegrationServiceResolver;
use App\Services\FeatureService;
use App\Models\Schedulers;

class OrderTransferJob implements ShouldQueue // Implemented ShouldQueue for queueing
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $store;
    public $Scheduler;

    public function __construct(Stores $store, Schedulers $Scheduler)
    {
        $this->store = $store;
        $this->Scheduler = $Scheduler;
    }

    /**
     * Execute the job.
     */
    public function handle(IntegrationServiceResolver $resolver, FeatureService $featureService): void
    {
        $startTime = microtime(true);
        $currentTime = Carbon::now()->format('Y-m-d H:i:s');

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
        
        if (!$service) {
            Log::error("Service not found for store: {$this->store->name}");
            return;
        }

        $response = $service->execute($this->store, $this->Scheduler, $options);

        $executionTime = round(microtime(true) - $startTime, 2);
        Log::info("Execution time: {$executionTime} seconds");

        $this->Scheduler->update(['execution_time' => $executionTime, 'last_run' => $currentTime]);

        if (isset($response['error']) && $response['error']) {

            $attempts = $this->attempts();
            $this->Scheduler->increment('attempts', $attempts);
            
            $data = [
                'customer_id' => $customer->id,
                'store_id' => $this->store->id,
                'event_type' => 'order_transfer',
                'event_action' => 'automatic',
                'status' => 'failure',
                'message' => $response['message'] ?? 'Error from Shopify',
                'payload' => $response,
            ];

            storeLog($data); // Assuming storeLog is a custom function, otherwise use Log::error()

            return;
        }

    }
}