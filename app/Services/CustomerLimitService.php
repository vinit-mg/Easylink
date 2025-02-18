<?php

namespace App\Services;

use App\Models\Customers;
use App\Models\CustomerUsage;
use App\Models\Stores;
use Carbon\Carbon;

class CustomerLimitService
{
    protected $customer;
    protected $store;
    protected $month;
    protected $year;

    public function __construct(Customers $customer, Stores $store)
    {
        $this->customer = $customer;
        $this->store = $store;

        $this->month = Carbon::now()->month;
        $this->year = Carbon::now()->year;
    }

    /**
     * Get the order transfer limit for the customer.
    */

    public function getOrderLimit()
    {
        $subscription = $this->customer->ActiveSubscription;

        $packagefetures = $subscription->package->getFeaturesForSourceAndDestination($this->store->source->id, $this->store->destination->id);
        
        $order_transfer_limit = 0;
        if(!$packagefetures->isEmpty()){
            foreach($packagefetures as $packagefeture){
                
            }
        }


        return $subscription->order_limit + ($addons->extra_orders ?? 0);
        
    }

    /**
     * Get the customer transfer limit for the customer.
     */
    public function getCustomerLimit()
    {
        $subscription = $this->customer->subscription;
        $addons = $this->customer->addons;

        return $subscription->customer_limit + ($addons->extra_customers ?? 0);
    }

    /**
     * Get the current usage for the customer.
     */
    public function getUsage()
    {
        return CustomerUsage::firstOrCreate(
            ['customer_id' => $this->customer->id, 'month' => $this->month, 'year' => $this->year],
            [
                'used_orders' => 0, 
                'used_customers' => 0,
                'used_inventories' => 0,
                'used_products' => 0,
            ]
        );
    }

    /**
     * Check if the customer has reached the order limit.
     */
    public function hasReachedOrderLimit()
    {
        return $this->getUsage()->used_orders >= $this->getOrderLimit();
    }

    /**
     * Check if the customer has reached the customer limit.
     */
    public function hasReachedCustomerLimit()
    {
        return $this->getUsage()->used_customers >= $this->getCustomerLimit();
    }

    /**
     * Increment the used orders count.
     */
    public function incrementOrders($count = 1)
    {
        if (!$this->hasReachedOrderLimit()) {
            $this->getUsage()->increment('used_orders', $count);
            return true;
        }
        return false;
    }

    /**
     * Increment the used customers count.
     */
    public function incrementCustomers($count = 1)
    {
        if (!$this->hasReachedCustomerLimit()) {
            $this->getUsage()->increment('used_customers', $count);
            return true;
        }
        return false;
    }
}
