<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelPackageTools\Package;

class Packages extends Model
{
    use HasFactory;

    protected $table = "packages";
    public $timestamps = true;
    protected $fillable = [
        'name',
        'base_price_monthly',
        'base_price_yearly',
        'created_at',
        'updated_at'
    ];

    public function customer_subscriptions()
    {
        return $this->hasMany(CustomerSubscriptions::class, 'package_id');
    }
    public function features()
    {
        return $this->hasMany(PackageFeatures::class, 'package_id');
    }

    public function getFeaturesForSourceAndDestination($source_id, $destination_id)
    {
        return $this->hasMany(PackageFeatures::class, 'package_id')->where('source_id', $source_id)->where('destination_id', $destination_id)->get();
    }
    
    public static function formatColumnName($columnName)
    {
        return ucwords(str_replace('_', ' ', $columnName));
    }
}
