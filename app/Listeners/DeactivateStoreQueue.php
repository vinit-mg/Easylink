<?php

namespace App\Listeners;

use App\Events\StoreDeactivated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Process;

class DeactivateStoreQueue implements ShouldQueue
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
    public function handle(StoreDeactivated $event): void
    {
        Process::start("php artisan store:manage --action=deactivate --store={$event->storeId}");
    }
}
