<?php

namespace App\Console\Commands;

use App\Mail\TaskDueMail;
use App\Models\DueDate;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TaskItemDue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'taskitem:due';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Taskitem Due Date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $due_dates = DueDate::with('user')
        ->where('due_at', '>=', now())
        ->where('due_at', '<=', now()->addDays(3))
        ->whereHas('user')
        ->get();

        foreach ($due_dates as $due_date) {
            $mailUser = User::where('id', $due_date->user->id)->first();
            Mail::to($mailUser)->send(new TaskDueMail($due_date));

            // $notifications = new Notification();
            // $notifications->user_id = $due_date->user->id;
            // $notifications->schedule_id = null;
            // $notifications->due_date_id = $due_date->id;
            // $notifications->read_at = false;
            // $notifications->save();
        }

        return 0;
    }
}
