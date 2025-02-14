<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CustomerUsers extends Model
{
    use HasFactory;
    protected $table = "customer_users";
    public $timestamps = true;
    protected $fillable = ['customer_id', 'user_id', 'IsCustomerAdmin', 'created_at', 'updated_at'];

    public function customer()
    {
        return $this->belongsTo(Customers::class,'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
