<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddOnFeatures extends Model
{
    use HasFactory;

    protected $table = "add_on_features";
    public $timestamps = true;

    protected $fillable = ['name', 'add_on_id', 'source_id', 'destination_id', 'created_at', 'updated_at'];


    public function addOn()
    {
        return $this->belongsTo(AddOns::class);
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }
    
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public static function formatColumnName($columnName)
    {
        return ucwords(str_replace('_', ' ', $columnName));
    }
}
