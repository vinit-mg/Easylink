<?php
namespace App\Services;

use App\AddOns\ShippingMethods\ShopifyToAckro\ShippingMethods;

class AddOnServiceLoader{

    protected $Addons = [];

    public function __construct(){

        $this->Addons = [
            'ShippingMethods' => [
                'ShopifyToAckro' => [
                    'view' => (new ShippingMethods())::display(),
                ]
            ]
        ];

    }

    public function resolveService($source, $destination, $entity, $action){

        if (isset($this->Addons[$entity][$source.'To'.$destination][$action])) {

            $class = $this->Addons[$entity][$source.'To'.$destination][$action];
            return new $class();

        }

    }
}