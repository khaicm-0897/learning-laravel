<?php

namespace App\Console;

use Carbon\Carbon;
use Commands\SendMailCommand;
use Illuminate\Support\Facades\Log;
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
        SendMailCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('send-mail:run')
            ->daily()
            ->before(function () {
                Log::info('Start send email job at ' . Carbon::now()->format('Y-m-d H:i:s'));
            })
            ->after(function () {
                Log::info('End send email job at ' . Carbon::now()->format('Y-m-d H:i:s'));
            });
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
