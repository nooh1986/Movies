<?php

namespace App\Console;

use App\Console\Commands\GetGenres;
use App\Console\Commands\GetMovies;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('get:genres')->everyMinute();
        $schedule->command('get:movies')->everyMinute()->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        GetGenres::class;
        GetMovies::class;
        
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
