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
    protected $signature = 'store:schedule-tasks {--scheduler=}';
    protected $description = 'Run scheduled tasks for stores';

    public function handle()
    {

        $schedule_id = $this->option('scheduler');
        $scheduler = Schedulers::find($schedule_id);

        $this->executeFeatureTask($scheduler);

        $this->info('Scheduled tasks executed successfully.');
    }

    private function executeFeatureTask(Schedulers $scheduler)
    {
        $store = $scheduler->store;
        $customer = $store->customer;
        $queue = "store_{$store->id}"; // Store-specific queue

        Log::info("Executing {$scheduler->PackageFeature->feature_name} for Store: {$store->name} (Customer: {$customer->CompanyName})");
        
        switch ($scheduler->PackageFeature->feature_name) {
            case 'Order Transfer':
                OrderTransferJob::dispatch($store, $scheduler)->onQueue($queue.'_order_transfer');
                $this->info('order_transfer');
                break;
            case 'order_update':
                OrderUpdateJob::dispatch($store, $scheduler)->onQueue($queue.'_order_update');
                break;
            case 'Inventory Update':
                InventoryUpdateJob::dispatch($store, $scheduler)->onQueue($queue.'_inventory_update');
                break;
            case 'Customer transfer':
                CustomerTransferJob::dispatch($store, $scheduler)->onQueue($queue.'_customer_transfer');
                break;
            case 'product_update':
                ProductUpdateJob::dispatch($store, $scheduler)->onQueue($queue.'_product_update');
                break;
        }
    }
}
