<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class EmailTemplates extends Model
{
    use HasFactory, LogsActivity;

    public $timestamps = true;
    protected $fillable = [
        'TemplateName',
        'EmailSubject',
        'EmailFrom',
        'EmailTemplate',
        'created_at',
        'updated_at',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['TemplateName', 'EmailSubject', 'EmailFrom', 'EmailTemplate'])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs()
        ->setDescriptionForEvent(fn(string $eventName) => "Email template has been {$eventName}");
    }
}
