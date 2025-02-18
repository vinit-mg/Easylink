<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Schedulers extends Model
{
    use HasFactory;

    protected $table = "schedulers";
    protected $fillable = ['store_id', 'package_feature_id', 'frequency', 'next_run', 'last_run', 'attemts', 'IsActive', 'creted_at', 'updated_at'];
    public $timestamps = true;

    public function store()
    {
        return $this->belongsTo(Stores::class, 'store_id');
    }

    public function PackageFeature()
    {
        return $this->belongsTo(PackageFeatures::class, 'package_feature_id');
    }
      /**
     * Boot method to set next_run based on frequency before creating or updating.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($scheduler) {
            if ($scheduler->isDirty('frequency') || $scheduler->isDirty('last_run')) {
                $scheduler->setNextRun();
            }
        });
    }

    /**
     * Set the next run time based on the frequency.
     */
    public function setNextRun()
    {
        if ($this->last_run) {
            $lastRunTime = Carbon::parse($this->last_run);
        } else {
            $lastRunTime = Carbon::now();
        }

        switch ($this->frequency) {
            case '* * * * *': // Every minute
                $this->next_run = $lastRunTime->addMinute();
                break;
            case '*/5 * * * *': // Every 5 minutes
                $this->next_run = $lastRunTime->addMinutes(5);
                break;
            case '*/10 * * * *': // Every 10 minutes
                $this->next_run = $lastRunTime->addMinutes(10);
                break;
            case '*/15 * * * *': // Every 15 minutes
                $this->next_run = $lastRunTime->addMinutes(15);
                break;
            case '*/30 * * * *': // Every 30 minutes
                $this->next_run = $lastRunTime->addMinutes(30);
                break;
            case '0 * * * *': // Hourly
                $this->next_run = $lastRunTime->addHour();
                break;
            case '0 */6 * * *': // Every 6 hours
                $this->next_run = $lastRunTime->addHours(6);
                break;
            case '0 0 * * *': // Daily
                $this->next_run = $lastRunTime->addDay();
                break;
            case '0 0 1 * *': // Monthly
                $this->next_run = $lastRunTime->addMonth();
                break;
            case '0 0 1 1 *': // Yearly
                $this->next_run = $lastRunTime->addYear();
                break;
            default:
                $this->next_run = null;
                break;
        }
    }
}