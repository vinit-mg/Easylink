<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelPackageTools\Package;

class DestinationSettings extends Model
{
    use HasFactory;

    protected $table = "destination_settings";
    public $timestamps = true;

    protected $fillable = ['destination_id', 'package_feature_id', 'setting_name', 'setting_key', 'setting_description', 'IsActive', 'created_at', 'updated_at'];


    public function destination(){

        return $this->belongsTo(Destination::class);

    }

    public function package_feature(){

        return $this->belongsTo(PackageFeatures::class);

    }

}
