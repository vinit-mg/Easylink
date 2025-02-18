<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddOnPurchase extends Model
{
    use HasFactory;

    protected $table = "add_ons_purchases";
    public $timestamps = true;

    protected $fillable = ['customer_id', 'add_on_id', 'quantity', 'addon_price', 'total_price', 'purchased_at', 'created_at', 'updated_at'];

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function addOn()
    {
        return $this->belongsTo(AddOns::class, 'add_on_id');
    }
    
    public static function formatColumnName($columnName)
    {
        return ucwords(str_replace('_', ' ', $columnName));
    }
}
