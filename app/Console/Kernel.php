<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Apartment;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {

        $apartments = Apartment::all();

            foreach ($apartments as $apartment) {

                if ($apartment->sponsor == 1) {
                    $date = $apartment->app_date;
                    $adesso = Carbon::now();
                    $diff = $adesso->diffInSeconds($date);
                    if ($diff > 100) {
                        $apartment->sponsor = 0;
                        $apartment->save();
                    }
                } else if ($apartment->sponsor == 2) {
                    $date = $apartment->app_date;
                    $adesso = Carbon::now();
                    $diff = $adesso->diffInSeconds($date);
                    if ($diff > 72) {
                        $apartment->sponsor = 0;
                        $apartment->save();
                    }
                } if ($apartment->sponsor == 3) {
                    $date = $apartment->app_date;
                    $adesso = Carbon::now();
                    $diff = $adesso->diffInHours($date);
                    if ($diff > 144) {
                        $apartment->sponsor = 0;
                        $apartment->save();
                    }
                }

            }

        })->everyMinute();
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
