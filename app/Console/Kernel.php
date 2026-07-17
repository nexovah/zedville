<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\User;
use App\Helpers\MailboxScheduler;
use App\Models\Transfer;
use App\Jobs\ProcessScheduledTransfer;

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
        // Example: Run MailboxScheduler tasks
        $schedule->call(function () {
            $users = User::all();
            foreach ($users as $user) {
               MailboxScheduler::scheduleForEvent('login', $user->id);
            }
        })->everyMinute();

        // ----- Scheduled Transfers -----
        $schedule->call(function () {
            // Process "Later" transfers (scheduled_at <= now)
            $laterTransfers = Transfer::where('type', 'later')
                ->where('scheduled_at', '<=', now())
                ->get();

            foreach ($laterTransfers as $transfer) {
                ProcessScheduledTransfer::dispatch($transfer->id);
            }

            // Process "Recurring" transfers
            $recurringTransfers = Transfer::where('type', 'recurring')
                ->where(function ($query) {
                    $query->where('start_date', '<=', now())
                          ->where('end_date', '>=', now());
                })
                ->get();

            foreach ($recurringTransfers as $transfer) {
                ProcessScheduledTransfer::dispatch($transfer->id);
            }
        })->everyMinute(); // check every minute
        // ✅ ADD THIS (Badge Calculation)
    $schedule->command('badges:calculate-monthly')
        ->monthlyOn(31, '23:59')
        ->withoutOverlapping()
        ->runInBackground();
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
