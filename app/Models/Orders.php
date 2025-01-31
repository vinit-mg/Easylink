<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = "orders";
    public $timestamps = true;

    protected $fillable = [
        'store_id', 
        'order_id', 
        'OrderNumber', 
        'data', 
        'created_at', 
        'updated_at',
    ];

    public function store()
    {
        return $this->belongsTo(Stores::class, 'store_id');
    }

}
