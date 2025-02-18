<?php

namespace App\Listeners;

use App\Events\StoreActivated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Process;

class ActivateStoreQueue implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StoreActivated $event): void
    {
        Process::start("php artisan store:manage --action=activate --store={$event->storeId}");
    }
}
