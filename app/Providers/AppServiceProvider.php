<?php

namespace App\Providers;

use App\Models\Board;
use App\Models\Member;
use App\Models\Schedule;
use App\Models\Workspace;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (isset(auth()->user()->id)) {
                // $workspaces     = Workspace::where('user_id', auth()->user()->id)->where('id', Request::segment(2))->get();
                $userId = auth()->user()->id;

                $workspaces     = Workspace::where('id', Request::segment(2))->get();
                $workspacesList = Member::where('user_id', auth()->user()->id)->get();

                $notifications = Schedule::where('user_id', $userId)
                ->whereNotNull('end')
                ->where('end', '>=', Carbon::now())
                ->where('end', '<=', Carbon::now()->addDays(3)) 
                ->with('taskitem') 
                ->get();

                $view->with('workspaces', $workspaces);
                $view->with('workspacesList', $workspacesList);
                $view->with('notifications', $notifications);
            }
            $boards = Board::all();
            $view->with('boards', $boards);
        });

        // view()->composer('index.boards', function ($view) {
        //     $view->with('boards');
        // });
    }
}
