<?php

namespace App\Integrations\Shopify\Ackro\Orders;

use Illuminate\Http\Request;
use App\Libraries\Shopify\ShopifyClient;

class TransferOrder
{   
    public $ShopifyClient;

    public function execute($order_id, $store, $activeSubscription, $options = array()){

        $this->ShopifyClient = new ShopifyClient($store);

        if(empty($order_id)){
            throw new \InvalidArgumentException('Order not found');
        }

        $response = $this->ShopifyClient->getOrder($order_id);
      
        if($response['error']){
            return $response;
        }

        dd($options);
        
    }

    private function get_order_header(){
        return [
            "order_number" => "",
            "cust_name" => "",
            "cust_address" => [
                "zip_code" => "",
                "city" => "",
                "country" => "",
                "street" => ""
            ],
            "customer_reference" => "",
            "email" => "",
            "phone" => "",
            "mobile" => "",
            "cust_contact" => "",
            "delivery_name" => "",
            "delivery_address" => [
                "street" => "",
                "zip_code" => "",
                "city" => "",
                "country" => "",
                "state" => ""
            ],
            "receipt_date_requested" => "",
            "currency" => "",
            "delivery_term" => "",
            "delivery_mode" => "",
            "shop" => "",
            "status" => "",
            "customer_purch_order_num" => "",
            "delay_reason_code" => "",
            "language" => "",
            "cust_vat_number" => "",
            "note_pick" => "",
            "note_delivery" => "",
        ];
    }

    private function get_order_line_item(){
        return [
            "line_id" => "",
            "item_id" => "",
            "item_name" => "",
            "qty" => "",
            "external_line_id" => 0,
            "external_item_id" => 0,
            "status" => "Open",
            "unit" => "",
            "disc_amount" => 0,
            "disc_percent" => 0,
            "intra_code" => "",
            "orign_country" => "",
            "delivered_qty" => 0,
            "remain_qty" => 0,
            "batch_number" => "",
        ];
    }

    public function checklimit(){
        
    }
}