<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $table = "destination";
    public $timestamps = true;
    protected $fillable = [
        'DestinationName',
        'IsActive',
        'Remarks',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function destination_settings()
    {
        return $this->hasMany(DestinationSettings::class, 'destination_id');
    }
}
