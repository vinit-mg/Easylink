<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Stores extends Model
{
    use HasFactory, LogsActivity;

    protected $table = "stores";
    public $timestamps = true;
    protected $fillable = [
        'customer_id',
        'name',
        'source_id',
        'destination_id',
        'source_auth_id',
        'destination_auth_id',
        'IsDefault',
        'IsActive',
        'created_at',
        'updated_at'
    ];

    protected static function boot(){
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid(); // Auto-generate UUID on creation
        });
    }
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'customer_id', 
            'name', 
            'source_id', 
            'destination_id', 
            'source_auth_id',
            'source_auth.type',
            'source_auth.api_url',
            'source_auth.username',
            'source_auth.password',
            'source_auth.token',
            'source_auth.api_key',
            'source_auth.client_id',
            'source_auth.client_secret',
            'source_auth.additional_info',
            'source_auth.requires_dynamic_url', 
            'destination_auth.type',
            'destination_auth.api_url',
            'destination_auth.username',
            'destination_auth.password',
            'destination_auth.token',
            'destination_auth.api_key',
            'destination_auth.client_id',
            'destination_auth.client_secret',
            'destination_auth.additional_info',
            'destination_auth.requires_dynamic_url',
            ])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs()
        ->setDescriptionForEvent(fn(string $eventName) => "Store has been {$eventName}");
    }

    public function source()
    {
        return $this->belongsTo(Source::class, 'source_id');
    }
    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
    public function store_settings()
    {
        return $this->hasMany(StoreSettings::class, 'store_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id')->where('IsActive', 1);
    }
    public function source_auth()
    {
        return $this->belongsTo(Auth::class, 'source_auth_id');
    }
    public function destination_auth()
    {
        return $this->belongsTo(Auth::class, 'destination_auth_id');
    }

    public function activate()
    {
        $this->IsActive = true;
        return $this->save();
    }

    public function deactivate()
    {
        $this->IsActive = false;
        return $this->save();
    }

    public function enabledFeatures() {
        return $this->belongsToMany(AddOnFeatures::class, 'store_enabled_features', 'store_id', 'add_on_feature_id');
    }

    public function storePermissions()
    {
        return $this->hasMany(StorePermission::class,'store_id');
    }
    

    public function hasPermission($permissionName)
    {
        return $this->storePermissions()
            ->whereHas('permission', function ($query) use ($permissionName) {
                $query->where('feature_name', $permissionName);
            })
            ->exists();
    }
   
}
