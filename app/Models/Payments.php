<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $table = "payments";
    public $timestamps = true;
    protected $fillable = ['customer_id', 'invoice_id', 'amount', 'payment_method', 'transaction_id', 'description', 'payment_type', 'subscription_id', 'add_on_purchase_id', 'status', 'created_at', 'updated_at'];

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoices::class);
    }

    public function AddOnPurchase()
    {
        return $this->belongsTo(AddOnPurchase::class, 'add_on_purchase_id');
    }

    public function subscription()
    {
        return $this->belongsTo(CustomerSubscriptions::class);
    }

    public static function formatColumnName($columnName)
    {
        return ucwords(str_replace('_', ' ', $columnName));
    }
}
