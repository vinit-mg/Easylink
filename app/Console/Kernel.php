<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Schedulers;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('subscriptions:expire')->daily();
        $schedulers = Schedulers::all();

        foreach ($schedulers as $scheduler) {
            $schedule->command('store:schedule-tasks')
                ->{$scheduler->frequency}()->withoutOverlapping(); // Prevent duplicate job execution;
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
