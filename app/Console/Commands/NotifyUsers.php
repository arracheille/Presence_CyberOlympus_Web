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
        $schedules = Schedule::with('user')
                    ->where('end', '>=', now())
                    ->where('end', '<=', now()->addDays(3))
                    ->whereHas('user')
                    ->get();

        $arrayTask = [];
        foreach ($schedules as $schedule) {
            $mailUser = User::where('id', $schedule->user->id)->first();
            $arrayTask[] = $mailUser;
            Mail::to($mailUser)->send(new ScheduleMail($schedules->where('user_id', $schedule->user->id)));

            $notifications = new Notification();
            $notifications->user_id     = $schedule->user->id;
            $notifications->schedule_id = $schedule->id;
            $notifications->due_date_id = null;
            $notifications->read_at     = false;
            $notifications->save();
        }

        return 0;
    }
}
