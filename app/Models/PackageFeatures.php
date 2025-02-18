<?php
namespace App\Models;

use Faker\Provider\ar_EG\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageFeatures extends Model
{
    use HasFactory;
    protected $table = "packagefeatures";
    public $timestamps = true;
    protected $fillable = ['package_id', 'feature_name', 'type', 'source_id', 'destination_id', 'included_in_package', 'default_limit', 'include_scheduler', 'created_at', 'updated_at'];

    public function package()
    {
        return $this->belongsTo(Packages::class,'package_id');
    }

    public function source()
    {
        return $this->belongsTo(Source::class,'source_id');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class,'destination_id');
    }
    
    public function ExtraLimit()
    {
        return $this->hasMany(CustomerExtraLimits::class,'package_feature_id');
    }

    public static function formatColumnName($columnName)
    {
        return ucwords(str_replace('_', ' ', $columnName));
    }
}
