<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class DynamicFields extends Model
{
    use HasFactory, LogsActivity;

    protected $table = "dynamic_fields";
    protected $fillable = [
        'AuthId',
        'destination_id',
        'source_id',
        'field_name',
        'field_value',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'AuthId', 
            'destination_id', 
            'source_id', 
            'field_name', 
            'field_value', 
        ])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs()
        ->setDescriptionForEvent(fn(string $eventName) => "Dynamic field has been {$eventName}");
    }
    
    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class, 'source_id');
    }
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
    public function DynamicFields(): BelongsTo
    {
        return $this->belongsTo(Auth::class, 'AuthId');
    }
    
}
