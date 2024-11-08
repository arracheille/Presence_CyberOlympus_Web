<?php

namespace App\Console\Commands;

use App\Mail\ScheduleMail;
use App\Models\Notification;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;

class NotifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:due';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule Due Date';
    
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $getUserSchedules = User::whereHas('schedules', function($query) {
                            $query->where('end', '>=', now())
                            ->where('end', '<=', now()->addDays(3))
                            ->whereHas('user');
                            })
                            ->groupBy('users.id', 'users.name', 'users.email', 'users.usertype', 'users.email_verified_at', 'users.password', 'users.remember_token', 'users.created_at', 'users.updated_at')
                            ->get();

            // echo $getUserSchedules;
            // return false;

        foreach ($getUserSchedules as $userSchedule) {
            $schedules = Schedule::where('end', '>=', now())
                        ->where('end', '<=', now()->addDays(3))
                        ->where('user_id', $userSchedule->id)
                        ->get();

            foreach ($schedules as $schedule) {
                // $mailUser = User::where('id', $schedule->user->id)->first();
    
                $notifications = new Notification();
                $notifications->user_id     = $schedule->user->id;
                $notifications->schedule_id = $schedule->id;
                $notifications->due_date_id = null;
                $notifications->read_at     = false;
                $notifications->save();
            }

            Mail::to($userSchedule)->send(new ScheduleMail($schedules->where('user_id', $userSchedule->id)));
        }   

        return 0;
    }
}
