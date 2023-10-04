<?php

namespace App\Console;

use App\Modules\Currency\Jobs\FetchAndStoreCurrencies;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel
 *
 * The Kernel class is responsible for handling console commands and scheduling tasks in the application.
 */
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->job(new FetchAndStoreCurrencies())->dailyAt('03:00');
    }

    /**
     * Load the command classes and include the console routes file.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
