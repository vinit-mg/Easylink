<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Auth extends Model
{
    use HasFactory;

    protected $table = "auth";
    protected $fillable = [
        'type',
        'api_url',
        'requires_dynamic_url',
        'username',
        'password',
        'token',
        'api_key',
        'client_id',
        'client_secret',
        'additional_info',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

    public function DynamicFields(): HasMany
    {
        return $this->hasMany(DynamicFields::class, 'AuthId');
    }
    
}