<?php

namespace App\Console\Commands;

use App\Models\Assign;
use App\Models\TaskItem;
use App\Notifications\AssignNotification;
use Illuminate\Console\Command;

class AssignUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign-user:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User Assignment';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $assigns = Assign::with('user')
                ->where('id', '<=', auth()->user()->id)
                ->get();

        foreach ($assigns as $assign) {
            $assign->user->notify(new AssignNotification($assign));
            // $schedule->update(['end' => NULL]);
        }

        return 0;
    }
}
