<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddOns extends Model
{
    use HasFactory;

    protected $table = "add_ons";
    public $timestamps = true;

    protected $fillable = ['name', 'description', 'price', 'created_at', 'updated_at'];

    public function addOnPurchases()
    {
        return $this->hasMany(AddOnPurchase::class);
    }
    public function AddOnFeatures()
    {
        return $this->hasMany(AddOnFeatures::class, 'add_on_id');
    }
    public static function formatColumnName($columnName)
    {
        return ucwords(str_replace('_', ' ', $columnName));
    }
}
