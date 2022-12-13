<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
        // $schedule->command('inspire')
        //          ->hourly();
        //$schedule->command('backup:clean')->daily()->at('01:00');
        $schedule->command('backup:run')->daily()->at('05:00');
        $schedule->command('command:archiveBuild')->daily()->at('04:00');
        $schedule->command('command:actionhistories')->hourly();
        $schedule->command('command:populateRN')->twiceDaily(1, 13);
        // $schedule->command('command:generateSystemStats')->weekdays()->twiceDaily(1, 13);
        $schedule->command('command:getDBSize')->twiceDaily(2, 14);
        $schedule->command('command:command:archiveDBSizes')->twiceDaily(3, 15);
        $schedule->command('command:urlCheck')->weekdays()->everyFifteenMinutes();
        $schedule->command('command:stats1')->daily()->at('02:00');
        $schedule->command('command:command:archiveFI')->daily()->at('02:30');
        $schedule->command('command:jenAgent')->daily()->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
