<?php

namespace App\AddOns\ShippingMethods\ShopifyToAckro;

use App\AddOns\ShippingMethods\ShopifyToAckro\Controllers\ShippingMethodController;

class ShippingMethods
{
    public function __construct()
    {
        
    }
    public static function display()
    {
        return ShippingMethodController::class;
    }
}
