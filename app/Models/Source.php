<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $table = "source";
    public $timestamps = true;
    protected $fillable = [
        'SourceName',
        'IsActive',
        'Remarks',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function source_settings()
    {
        return $this->hasMany(SourceSettings::class, 'source_id');
    }
}
