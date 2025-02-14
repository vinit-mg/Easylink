<?php

namespace App\Events;

use App\Models\Customers;
use App\Models\Stores;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoreActivated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $storeId;

    public function __construct(Customers $customer, Stores $store)
    {
        $this->storeId = $store->id;
    }
}
