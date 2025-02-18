<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Schedulers;
use Illuminate\Support\Facades\Log;
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('subscriptions:expire')->daily();

$schedulers = Schedulers::all();

foreach ($schedulers as $scheduler) {
    if(!$scheduler->IsActive){
        continue;
    }
    Log::info("Scheduling tasks for scheduler: {$scheduler->id}");
    Schedule::command('store:schedule-tasks --scheduler='.$scheduler->id)
        ->{$scheduler->frequency}()->withoutOverlapping(); // Prevent duplicate job execution;
}