<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelPackageTools\Package;

class CustomerExtraLimits extends Model
{
    use HasFactory;

    protected $table = "customer_extra_limits";
    public $timestamps = true;

    protected $fillable = ['package_feature_id', 'customer_id', 'additional_limit', 'price', 'purchased_at', 'created_at', 'updated_at'];


    public function PackageFeature()
    {
        return $this->belongsTo(PackageFeatures::class, 'package_feature_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customers::class.'customer_id');
    }
}
