<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
//use App\Models\Job;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            DB::table('greff_jobs')->whereRaw('deadline_for_apply < now()')
                ->where('status', \App\Models\Job::STATUS['HIRING'])
                ->update(['status' => \App\Models\Job::STATUS['FINISH']]);
        })->everyMinute();
//
//        $schedule->call(function () {
//            Job::whereRaw('work_date < now()')
//                ->delete();
//        })->everyMinute();
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
