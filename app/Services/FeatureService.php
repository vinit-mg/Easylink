<?php

namespace App\Services;

use Illuminate\Support\Str;

class FeatureService
{
    public function getFeaturesForSubscription($customer)
    {
        $package = $customer->ActiveSubscription->package; // Assuming a relationship exists between Subscription and Package

        if (!$package) {
            throw new \Exception('No package associated with the subscription.');
        }
      
        // Fetch features based on the package
        $features = $package->features; // Assuming `features` returns a JSON or array of rules
       
        if($features->isEmpty()){
            throw new \Exception('No features found for this subscription.');
        }

        $SubscriptionFeature = array();
        
        foreach($features as $feature){
           
            if($feature->default_limit != null && !empty($feature->default_limit)){
                $key = Str::snake($feature->feature_name) . '_limit';
                $SubscriptionFeature[$key] = $feature->default_limit;
            } else {
                
                $key = Str::snake($feature->feature_name);
                $SubscriptionFeature[$key] = true;
            }

            if(!$customer->CustomerExtraLimits->isEmpty()){
                $extralimits = 0;
                $key = '';
                foreach($customer->CustomerExtraLimits as $ExtraLimit){
                    if($ExtraLimit->package_feature_id == $feature->id){
                        $extralimits += $feature->default_limit;
                        $key = Str::snake($feature->feature_name) . '_extra_limit';
                    }
                }

                if(!empty($key)){
                    $SubscriptionFeature[$key] = $extralimits;
                }
                
            }
        }

        return $SubscriptionFeature;
    }
}
