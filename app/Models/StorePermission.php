<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class StorePermission extends Model
{
    use HasFactory;

    protected $table = "store_permissions";
    protected $fillable = ['store_id', 'package_featurte_id', 'creted_at', 'updated_at'];
    public $timestamps = true;

    public function permission()
    {
        return $this->belongsTo(PackageFeatures::class, 'package_featurte_id');
    }
}