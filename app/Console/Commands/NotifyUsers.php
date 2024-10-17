<?php

namespace App\Console\Commands;

use App\Mail\ScheduleMail;
use App\Models\Schedule;
use App\Models\User;
use App\Notifications\TaskItemNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;

class NotifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task_due:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Taskitem is almost due';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $schedules = Schedule::with('user')
        ->where('end', '>=', now())
        ->where('end', '<=', now()->addDays(3))
        ->get();

        $groupedSchedules = [];
        foreach ($schedules as $schedule) {
            $groupedSchedules[$schedule->user->id][] = $schedule;
        }

        foreach ($groupedSchedules as $userId => $schedules) {
            $user = User::find($userId);
            Mail::to($user->email)->send(new ScheduleMail($schedules));
            // $user->Mail(new ScheduleMail($schedules));
        }
        return 0;
    }
}
