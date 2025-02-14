<?php
namespace App\Models;

use Faker\Provider\ar_EG\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSubscriptions extends Model
{
    use HasFactory;
    protected $table = "customer_subscriptions";
    public $timestamps = true;
    protected $fillable = ['customer_id', 'package_id', 'billing_cycle', 'start_date', 'end_date', 'status', 'created_at', 'updated_at'];

    public function customer()
    {
        return $this->belongsTo(Customers::class,'customer_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoices::class,'customer_subscription_id');
    }

    public function package()
    {
        return $this->belongsTo(Packages::class,'package_id');
    }

    public function AddOnPurchase()
    {
        return $this->hasMany(AddOnPurchase::class,'customer_subscription_id');
    }

    public function payments()
    {
        return $this->hasMany(Payments::class);
    }
    
    public static function formatColumnName($columnName)
    {
        return ucwords(str_replace('_', ' ', $columnName));
    }

    public function ExtraLimits()
    {
        return $this->hasMany(CustomerExtraLimits::class,'customer_subscription_id');
    }
}
