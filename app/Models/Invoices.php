<?php

namespace App\Models;

use Faker\Provider\ar_EG\Customer;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;

    protected $table = "invoices";
    public $timestamps = true;

    protected $fillable = [
        'name', 
        'invoice_number', 
        'customer_id', 
        'user_id', 
        'customer_subscription_id', 
        'total_amount',
        'tax_amount',
        'discount_amount',
        'net_amount',
        'status',
        'issued_at',
        'due_date',
        'created_at',
        'updated_at',
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
