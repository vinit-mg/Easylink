<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Schedulers;
use Illuminate\Support\Facades\Log;
use App\Jobs\OrderTransferJob;
use App\Jobs\OrderUpdateJob;
use App\Jobs\InventoryUpdateJob;
use App\Jobs\CustomerTransferJob;
use App\Jobs\ProductUpdateJob;

class StoreFeatureScheduler extends Command
{
    protected $signature = 'store:schedule-tasks';
    protected $description = 'Run scheduled tasks for stores';

    public function handle()
    {
        $schedulers = Schedulers::with('store.customer')->get();

        foreach ($schedulers as $scheduler) {
            if(!$scheduler->IsActive){
                continue;
            }
            $this->executeFeatureTask($scheduler);
        }

        $this->info('Scheduled tasks executed successfully.');
    }

    private function executeFeatureTask(Schedulers $scheduler)
    {
        $store = $scheduler->store;
        $customer = $store->customer;
        $queue = "store_{$store->id}"; // Store-specific queue

        Log::info("Executing {$scheduler->feature} for Store: {$store->name} (Customer: {$customer->name})");

        switch ($scheduler->feature) {
            case 'order_transfer':
                OrderTransferJob::dispatch($store)->onQueue($queue.'_order_transfer');
                break;
            case 'order_update':
                OrderUpdateJob::dispatch($store)->onQueue($queue.'_order_update');
                break;
            case 'inventory_update':
                InventoryUpdateJob::dispatch($store)->onQueue($queue.'_inventory_update');
                break;
            case 'customer_transfer':
                CustomerTransferJob::dispatch($store)->onQueue($queue.'_customer_transfer');
                break;
            case 'product_update':
                ProductUpdateJob::dispatch($store)->onQueue($queue.'_product_update');
                break;
        }
    }
}
