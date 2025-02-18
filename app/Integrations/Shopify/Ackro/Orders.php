<?php

namespace App\Integrations\Shopify\Ackro;

use App\Integrations\Shopify\Ackro\Orders\GetOrders;
use App\Integrations\Shopify\Ackro\Orders\ViewOrders;
use App\Integrations\Shopify\Ackro\Orders\TransferOrder;
use App\Integrations\Shopify\Ackro\Orders\SyncOrders;


class Orders
{
    public static function get()
    {
        return GetOrders::class;
    } 

    public static function View()
    {
        return ViewOrders::class;
    }

    public static function transfer()
    {
        return TransferOrder::class;
    } 
    public static function sync()
    {
        return SyncOrders::class;
    }
}