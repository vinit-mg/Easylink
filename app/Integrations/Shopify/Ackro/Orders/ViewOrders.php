<?php

namespace App\Integrations\Shopify\Ackro\Orders;

use App\Libraries\Shopify\ShopifyClient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ViewOrders
{
    public $ShopifyClient;

    public function execute(Request $request, $store, $activeSubscription, $options = array())
    {
        $this->ShopifyClient = new ShopifyClient($store);

        $response = $this->ShopifyClient->getOrder($request->id);
        // dd($response);
        return $response;

    }
}