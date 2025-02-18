<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreEnabledFeatures extends Model
{
    use HasFactory;

    protected $table = "store_enabled_features";
    public $timestamps = true;

    protected $fillable = ['store_id', 'add_on_feature_id', 'IsActive', 'created_at', 'updated_at'];
}
