<?php

namespace App\Models;

use Faker\Provider\ar_EG\Customer;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;

    protected $connection = 'mysql2'; // Use the second database
    protected $table = "logs";
    public $timestamps = true;

    protected $fillable = [
        'customer_id', 'store_id', 'user_id', 'event_type', 'event_action', 'status', 'message', 'payload'
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function subscription()
    {
        return $this->belongsTo(CustomerSubscriptions::class, 'customer_subscription_id');
    }
    public function AddOnPurchase()
    {
        return $this->belongsTo(AddOnPurchase::class, 'add_ons_purchase_id');
    }

    public function payments()
    {
        return $this->hasMany(Payments::class, 'payment_id');
    }

}
