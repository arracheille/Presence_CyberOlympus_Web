<?php

use App\Http\Controllers\AdminTodoController;
use App\Models\Board;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskItemController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CoverController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\LabelController;
use App\Models\Schedule;
use App\Models\Task;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/attendance', [PageController::class, 'attendance'])->name('attendance');

    Route::get('/schedule', function () {
        $schedules = Schedule::all();
        return view('schedule.index', ['schedules' => $schedules]);
    })->name('schedule');
    Route::post('/schedule-create', [ScheduleController::class, 'create']);
    Route::get('/schedule-edit/{schedule}', [ScheduleController::class, 'edit']);
    Route::put('/schedule-edit/{schedule}', [ScheduleController::class, 'update']);
    Route::delete('/schedule-delete/{schedule}', [ScheduleController::class, 'destroy']);

    Route::get('/boards', function () {
        $boards = Board::orderBy('created_at', 'desc')->get();
        return view('boards.index', ['boards' => $boards]);
    })->name('boards.index');

    Route::post('/create-board', [BoardController::class, 'create']);
    Route::get('/edit-board/{board}', [BoardController::class, 'edit']);
    Route::put('/edit-board/{board}', [BoardController::class, 'update']);
    Route::delete('/delete-board/{board}', [BoardController::class, 'destroy']);
    
    Route::get('/board-task/{board}', function ($boardId) {
        $schedules = Schedule::all();
        $board = Board::findOrFail($boardId);
        $tasks = Task::where('board_id', $boardId)
                     ->orderBy('position', 'asc')
                     ->get();
        return view('tasks.index', compact('tasks', 'board', 'schedules'));
    })->name('tasks.index');

    Route::post('/task-create', [TaskController::class, 'create']);
    Route::get('/task-edit/{task}', [TaskController::class, 'edit']);
    Route::put('/task-edit/{task}', [TaskController::class, 'update']);
    Route::delete('/task-delete/{task}', [TaskController::class, 'destroy']);
    
    Route::post('/schedule-component-create', [ScheduleController::class, 'create_due']);
    
    Route::post('/tasks/update-order', [TaskController::class, 'updateOrder'])->name('tasks.updateOrder');
    Route::post('/task-item-update-position', [TaskItemController::class, 'updatePosition'])->name('task-item.updatePosition');
    
    Route::post('/task-item-create', [TaskItemController::class, 'create']);
    Route::get('/task-item-edit/{taskitem}', [TaskItemController::class, 'edit']);
    Route::put('/task-item-edit/{taskitem}', [TaskItemController::class, 'update']);
    Route::delete('/task-item-delete/{taskitem}', [TaskItemController::class, 'destroy']);
    
    Route::post('/label-create', [LabelController::class, 'create']);
    Route::get('/label-edit/{label}', [LabelController::class, 'edit']);
    Route::put('/label-edit/{label}', [LabelController::class, 'update']);
    Route::delete('/label-delete/{label}', [LabelController::class, 'destroy']);
    
    Route::post('/cover-create', [CoverController::class, 'create']);
    
    Route::post('/check-create', [CheckController::class, 'create']);
    Route::get('/check-edit/{check}', [CheckController::class, 'edit']);
    Route::put('/check-update', [CheckController::class, 'update']);
    Route::delete('/check-delete/{check}', [CheckController::class, 'destroy']);
    
    Route::post('/checklist-create', [ChecklistController::class, 'create']);
    Route::get('/checklist-edit/{checklist}', [ChecklistController::class, 'edit']);
    Route::put('/checklist-update', [ChecklistController::class, 'update'])->name('checklist.update');
    Route::delete('/checklist-delete/{checklist}', [ChecklistController::class, 'destroy']);
    
    Route::post('/comment-create', [CommentController::class, 'create']);
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/db/user', function () {
        $users = User::with(['boards', 'tasks', 'schedules'])->latest()->get();
        return view('admin.db-user', compact('users'));
    })->name('admin.db-user');
    
    Route::get('/db/todo', function () {
        $boards = Board::all();
        return view('admin.db-todo', ['boards' => $boards]);
    })->name('admin.db-todo');

    Route::get('/db/schedule', function () {
        $schedules = Schedule::all();
        return view('admin.db-schedule', ['schedules' => $schedules]);
    })->name('admin.db-schedule');

    Route::get('/logs', function () {
        $logactivity = \Spatie\Activitylog\Models\Activity::orderBy('created_at', 'desc')->get();
        return view ('admin.logs', [
            'logs' => $logactivity,
        ]);
    })->name('logs');

    Route::get('/db/attendance', [AttendanceController::class, 'index'])->name('admin.db-attendance');
    Route::post('/db/attendance', [AttendanceController::class, 'store']);
    Route::put('/db/attendance/update/{id}', [AttendanceController::class, 'update']);
    Route::delete('/db/attendance/delete/{id}', [AttendanceController::class, 'destroy']);
});

Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/user-details/{user}', function (User $user) {
        return view('superadmin.user-detail', ['user' => $user]);
    })->name('user-detail');
});

Route::get('admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admindashboard')->middleware(['auth', 'admin']);

Route::get('superadmin/dashboard', [HomeController::class, 'superadminDashboard'])->name('superadminadmindashboard')->middleware(['auth', 'superadmin']);