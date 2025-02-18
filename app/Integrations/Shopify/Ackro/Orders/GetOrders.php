<?php

namespace App\Integrations\Shopify\Ackro\Orders;

use App\Libraries\Shopify\ShopifyClient;
use Carbon\Carbon;

class GetOrders
{
    public $ShopifyClient;

    public function execute($store, $activeSubscription, $options = array())
    {
        $this->ShopifyClient = new ShopifyClient($store);

        $start_date = Carbon::parse($activeSubscription->start_date)->setTimezone('UTC')->format('Y-m-d\TH:i:s\Z');
        $default_options = array(
            'rows_per_page' => 10,
            'current_page_no' => '',
            'cursor_position' => 'after',
            'order_number' => '',
            'created_at' => $start_date,
            'shopify_order_transfer_payment_status' => implode(' OR ', getStoreSetting($store->id, 'shopify_order_transfer_payment_status', '')),
            'shopify_order_transfer_fulfillment_status' => implode(' OR ', getStoreSetting($store->id, 'shopify_order_transfer_fulfillment_status', '')),
        );
       
        $filterOptions = array_merge($default_options, $options);
     
        $response = $this->ShopifyClient->getOrders($filterOptions);
     
        return $response;

    }
}