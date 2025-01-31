<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Customers extends Model
{
    use HasFactory;

    protected $fillable = [
        'CompanyName',
        'CompanyLogo',
        'CompanyLogo',
        'AccessURL',
        'CustomerNo',
        'Address',
        'ZipCode',
        'Town',
        'Country',
        'CVR_no',
        'PhoneNo',
        'Dealer',
        'IsActive',
        'IsDefault',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
    public $timestamps = true;

    protected static function boot(){
    
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid(); // Auto-generate UUID on creation
        });
    }
    
    public function stores()
    {
        return $this->hasMany(Stores::class,'customer_id');
    }
    public function subscriptions()
    {
        return $this->hasMany(CustomerSubscriptions::class,'customer_id');
    }
    public function ActiveSubscription()
    {
        return $this->hasOne(CustomerSubscriptions::class,'customer_id')->where('status', 'active');
    }
   
    public function CustomerUsers()
    {
        return $this->hasMany(CustomerUsers::class, 'customer_id');
    }
    public function CustomerUser()
    {
        return $this->hasOne(CustomerUsers::class, 'customer_id');
    }
}
