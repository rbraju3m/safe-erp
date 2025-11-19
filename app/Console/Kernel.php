<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Weekly backup every Sunday at 02:00
        $schedule->command('backup:run')->weekly()->sundays()->at('02:00');

        // Cleanup old backups 10 minutes later
        $schedule->command('backup:clean')->weekly()->sundays()->at('02:10');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
