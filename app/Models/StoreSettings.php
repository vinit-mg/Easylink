<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelPackageTools\Package;

class StoreSettings extends Model
{
    use HasFactory;

    protected $table = "store_settings";
    public $timestamps = true;

    protected $fillable = ['store_id', 'meta_key', 'meta_value', 'created_at', 'updated_at'];


    public function store(){

        return $this->belongsTo(Stores::class);

    }

}
