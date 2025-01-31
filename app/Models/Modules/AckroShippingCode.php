<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelPackageTools\Package;

class AckroShippingCode extends Model
{
    use HasFactory;

    protected $table = "ackro_shipping_code";
    public $timestamps = true;

    protected $fillable = ['name', 'code', 'IsActive', 'created_at', 'updated_at'];
}
