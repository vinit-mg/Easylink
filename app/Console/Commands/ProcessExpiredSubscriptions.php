<?php

namespace App\Console\Commands;

use App\Models\Customers;
use App\Models\CustomerSubscriptions;
use Illuminate\Console\Command;
use App\Models\Subscription;
use Carbon\Carbon;

class ProcessExpiredSubscriptions extends Command
{
    protected $signature = 'subscriptions:expire';
    protected $description = 'Process expired subscriptions';

    public function handle()
    {
        $expiredSubscriptions = CustomerSubscriptions::whereDate('end_date', '<=', Carbon::now())
            ->where('status', 'active')
            ->update(['status' => 'expired']);
        
        $this->info("Processed {$expiredSubscriptions} expired subscriptions.");
    }
}
