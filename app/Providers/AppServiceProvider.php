<?php

namespace App\Providers;

use App\Models\Board;
use App\Models\Member;
use App\Models\Task;
use App\Models\Workspace;
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
                $workspaces     = Workspace::where('id', Request::segment(2))->get();
                $workspacesList = Member::where('user_id', auth()->user()->id)->get();

                $view->with('workspaces', $workspaces);
                $view->with('workspacesList', $workspacesList);
            }
            $boards = Board::all();
            $view->with('boards', $boards);
            $tasks = Task::all();
            $view->with('tasks', $tasks);
        });
    }
}
