<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'month',
        'year',
        'used_orders',
        'used_customers',
        'used_inventories',
        'used_products',
        'created_at',
        'updated_at',
    ];
    protected $table = "customer_usage";
    public $timestamps = true;
}
