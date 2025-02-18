<?php

namespace App\Integrations\Shopify\Ackro\Orders;

use App\Libraries\Shopify\ShopifyClient;
use Carbon\Carbon;

class SyncOrders
{
    public $ShopifyClient;

    public function execute($store, $options = array())
    {
        $this->ShopifyClient = new ShopifyClient($store);

        $ActiveSubscription = $store->customer->ActiveSubscription;

        if(empty($store->last_run)){

            $last_run = Carbon::parse($ActiveSubscription->start_date)->setTimezone('UTC')->format('Y-m-d\TH:i:s\Z');

        } else {

            $last_run = Carbon::parse($store->last_run)->setTimezone('UTC')->format('Y-m-d\TH:i:s\Z');

        }
       
        $default_options = array(
            'rows_per_page' => 10,
            'current_page_no' => '',
            'cursor_position' => 'after',
            'order_number' => '',
            'created_at' => $ActiveSubscription->start_date,
            'last_run' => $last_run,
            'shopify_order_transfer_payment_status' => implode(' OR ', getStoreSetting($store->id, 'shopify_order_transfer_payment_status', '')),
            'shopify_order_transfer_fulfillment_status' => implode(' OR ', getStoreSetting($store->id, 'shopify_order_transfer_fulfillment_status', '')),
        );
      
        $filterOptions = array_merge($default_options, $options);
       
        $startTime = microtime(true);
        $response = $this->ShopifyClient->getOrders($filterOptions, true);
       
        if(!$response['error']){
            if(!empty($response['response']['edges'])){
                foreach($response['response']['edges'] as $orderedge){
                    $node = $orderedge['node'];
                }
            }
        }
     
        $executionTime = round(microtime(true) - $startTime, 2);
       
        // dd($response);
        return $response;

    }
}