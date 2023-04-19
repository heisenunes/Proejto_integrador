<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\AverageSessionDuration;
use App\Models\UserSessionDuration;

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
        $schedule->call(function() {
            $current_sessions = UserSessionDuration::all();
            foreach ($current_sessions as $session) {
                if ((time() - $session->last_request_time) > 600) { // last user activity was more than 10 minutes ago
                    if (AverageSessionDuration::where('day', date('Y-m-d'))->exists()) {
                        // Daily session average exists in database
                        $averageSessionDuration = AverageSessionDuration::where('day', date('Y-m-d'))->first();
                        $averageSessionDuration->average_duration = ($averageSessionDuration->average_duration * $averageSessionDuration->session_count + $session->session_duration) / ($averageSessionDuration->session_count + 1);
                        $averageSessionDuration->increment('session_count');
                        $averageSessionDuration->save();
                    } else {
                        // Daily session average does not exist
                        $averageSessionDuration = AverageSessionDuration::create([
                            'day' => date('Y-m-d'),
                            'average_duration' => $session->session_duration,
                            'session_count' => 1
                        ]);
                        $averageSessionDuration->save();
                    }
                    UserSessionDuration::destroy($session->id);
                }
            }
        })->everyTwoHours();
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
