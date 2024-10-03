<?php

namespace App\Console\Commands;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Console\Command;

class NotifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $schedules = Schedule::whereNotNull('end')->get();
        // foreach($schedules as $schedule) {
        //   $diffInDays = $schedule->end->diff(Carbon::now())->days;
      
        //   $schedule->notify("Your deadline is in $diffInDays day!");
        // }
      
    }
}
