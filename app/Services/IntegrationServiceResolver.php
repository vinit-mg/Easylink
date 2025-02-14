<?php

namespace App\Services;

use App\Integrations\Shopify\Ackro\Orders;

// Add more integrations here as needed for Source2, Source3, etc.

class IntegrationServiceResolver
{
    protected $integrations = [];

    public function __construct()
    {
        $this->integrations = [
            'Shopify' => [
                'Ackro' => [
                    'Orders' => [
                        'Get' => Orders::get(),
                        'View' => Orders::View(),
                        'Transfer' => Orders::transfer(),
                    ],
                   
                ],
               
            ],
        
        ];
    }

    public function resolveService($source, $destination, $entity, $action)
    {
        // Check if the source, destination, entity, and action combination exists
        if (isset($this->integrations[$source][$destination][$entity][$action])) {
            $class = $this->integrations[$source][$destination][$entity][$action];
            return new $class();
        }

        throw new \Exception("Service not found for the given source, destination, entity, and action.");
    }
}
