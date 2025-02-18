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

class ProductUpdateJob implements ShouldQueue
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
    public function handle(): void
    {
        Log::info("Running Product Update Job for store: {$this->store->name}");
        
    }
}
