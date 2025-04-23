<?php

namespace App\Console;

use App\Console\Commands\SendPackageReminder;
use App\Console\Commands\SendExpirationDate;
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
        'App\Console\Commands\SendPackageReminder',
        'App\Console\Commands\SendExpirationDate'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // it will trigger with the consideration of end_date
        $schedule->command(SendPackageReminder::class, ['beforeEndDate'])->dailyAt('22:00');
        // it will trigger with the consideration of grace_date
        $schedule->command(SendPackageReminder::class, ['beforeGraceDate'])->dailyAt('22:00');
        // it will trigger with the consideration of grace_date expiration
        $schedule->command(SendPackageReminder::class, ['subscriptionExpired'])->dailyAt('22:00');
        // it will trigger with the consideration of expiration_date of job expiration
        $schedule->command(SendExpirationDate::class)->dailyAt('22:00');
        // to remove telescope logs older than 72 hours
        $schedule->command('telescope:prune --hours=72')->daily();
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

    /**
     * Get the timezone that should be used by default for scheduled events.
     *
     * @return \DateTimeZone|string|null
     */
    protected function scheduleTimezone()
    {
        return config('constants.display_date_timezone', 'UTC');
    }
}
