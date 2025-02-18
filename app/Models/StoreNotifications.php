<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StoreNotifications extends Model
{
    use HasFactory;

    public $timestamps = true;
    
    protected $fillable = [
        'EmailTemplateID',
        'StoreID',
        'CustomerID',
        'IsActive',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function store(): BelongsTo
    {
        return $this->BelongsTo(Stores::class,'StoreID');
    }
    public function usernotifications(): HasMany
    {
        return $this->HasMany(UserNotifications::class,'StoreNotificationID');
    }
    public function emailtemplate(): BelongsTo
    {
        return $this->BelongsTo(EmailTemplates::class,'EmailTemplateID');
    }
    public function customer(): BelongsTo
    {
        return $this->BelongsTo(Customers::class, 'CustomerID');
    }
}
