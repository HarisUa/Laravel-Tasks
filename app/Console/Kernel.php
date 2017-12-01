<?php

namespace App\Console;

use Mail;
use DB;
use App\User;
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

        $schedule->call(function() {
            $notes = DB::table('notes')->get();
            foreach ($notes as $note) {
                $diff = new \DateTime();
                $diff = $note->deadline;
                $now = new \DateTime('now');
                $fromuser = User::findOrFail($note->user_id)->name;
                $user = User::findOrFail($note->for_id);
                if ($now > $diff) {
                    Mail::send('emails.reminder', ['fromuser' => $fromuser, 'task' => $note], function ($m) use ($user) {
                            $m->from('admin@laravel.vagrant', 'Deadline is coming');

                            $m->to($user->email, $user->name)->subject('Deadline!!!');
                    });
                }
            }
        //})->daily();
        })->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
