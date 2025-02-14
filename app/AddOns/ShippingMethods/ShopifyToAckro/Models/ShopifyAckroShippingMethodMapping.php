<?php

namespace App\AddOns\ShippingMethods\ShopifyToAckro\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Stores;
use App\Models\AddOnFeatures;
use App\Models\Modules\AckroShippingCode;

class ShopifyAckroShippingMethodMapping extends Model
{
    use HasFactory;

    protected $table = "shopifyackroshippingmethodmapping";
    public $timestamps = true;

    protected $fillable = ['store_id', 'add_on_feature_id', 'shopify_shipping_method_name', 'ackro_shippping_code_id', 'drop_point', 'IsActive', 'created_at', 'updated_at'];


    public function store()
    {
        return $this->belongsTo(Stores::class, 'store_id');
    }

    public function AddOnFeature()
    {
        return $this->belongsTo(AddOnFeatures::class, 'add_on_feature_id');
    }

    public function ackro_shippping_code()
    {
        return $this->belongsTo(AckroShippingCode::class, 'ackro_shippping_code_id');
    }
}
