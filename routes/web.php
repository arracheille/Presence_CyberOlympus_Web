<?php

use App\Http\Controllers\AssignCheckController;
use App\Http\Controllers\AssignChecklistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssignController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskItemController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CoverController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DueDateController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TaskitemMemberController;
use App\Http\Controllers\WorkspaceController;
use App\Models\Member;
use App\Models\Schedule;
use App\Models\Board;
use App\Models\Task;
use App\Models\TaskItem;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

// use App\Http\Middleware\CheckMember;

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

    Route::get('/user-archive', function (User $user) {
        $user = User::where('id', auth()->user()->id)->first();
        $Archived_workspaces = Workspace::where('user_id', auth()->user()->id)->onlyTrashed()->get();
        $Archived_boards = Board::where('user_id', auth()->user()->id)->onlyTrashed()->get();
        $Archived_tasks = Task::where('user_id', auth()->user()->id)->onlyTrashed()->get();
        $Archived_taskitems = TaskItem::whereHas('tasks', function ($query) {
                                    $query->where('user_id', auth()->user()->id);
                                })->onlyTrashed()->get();
        $Archived_schedules = Schedule::where('user_id', auth()->user()->id)->onlyTrashed()->get();
        return view('archive.user-archive', compact('Archived_workspaces', 'Archived_boards', 'Archived_tasks', 'Archived_taskitems', 'Archived_schedules', 'user'));
    })->name('user.archive');

    Route::get('/workspace', function () {
        $workspaces = Workspace::all();
        return view('workspaces.index', compact('workspaces'));
    })->name('workspaces.index');

    Route::post('/send-w-code', [CodeController::class, 'sendUniqueCode']);

    Route::get('/get-w-code', function (Request $request) {
        $findWorkspace = Workspace::where('unique_code', $request->unique_code)->first();
        if ($findWorkspace) {
            $insertMember = new Member;
            $insertMember->user_id = auth()->user()->id;
            $insertMember->email = auth()->user()->email;
            $insertMember->role         = 'member';
            $insertMember->workspace_id = $findWorkspace->id;
            $insertMember->unique_code = $findWorkspace->unique_code;
            $insertMember->save();
    
            return redirect('/workspace/' . $findWorkspace->id);
        } else {
            return redirect()->back()->with('error', 'Workspace not found!');
        }
    })->name('workspaces.join-email');

    Route::post('/workspace/join', function (Request $request) {
        $findWorkspace = Workspace::where('unique_code', $request->unique_code)->first();
        if ($findWorkspace) {
            $insertMember               = new Member;
            $insertMember->user_id      = auth()->user()->id;
            $insertMember->email        = auth()->user()->email;
            $insertMember->role         = 'member';
            $insertMember->workspace_id = $findWorkspace->id;
            $insertMember->unique_code  = $findWorkspace->unique_code;
            $insertMember->save();
            return redirect('/workspace/'. $findWorkspace->id);
        } else {
            return redirect()->back()->with('error', 'Workspace not found!');
        }
    })->name('workspaces.join');

    Route::get('/get-schedule', function (Workspace $workspace, Schedule $schedule) {
        $findWorkspace = Workspace::where('id', $schedule->workspace->id)
                                ->where('user_id', $schedule->user->id)
                                ->first();
        if ($findWorkspace) {
            return redirect('schedule.index');
        } else {
            return redirect()->back()->with('error', 'Workspace not found!');
        }
    })->name('schedule.get');

    Route::delete('/workspace-leave/{member}', [MemberController::class, 'leave']);

    Route::get('/workspace/{workspace}', function (Workspace $workspace) {
        return view('workspaces.dashboard', compact('workspace'));
    })->name('workspaces.dashboard');

    Route::post('/create-workspace', [WorkspaceController::class, 'create']);
    Route::get('/edit-workspace/{workspace}', [WorkspaceController::class, 'edit']);
    Route::put('/edit-workspace/{workspace}', [WorkspaceController::class, 'update']);
    Route::delete('/delete-workspace/{workspace}', [WorkspaceController::class, 'destroy'])->withTrashed();
    Route::post('/restore-workspace/{workspace}', [WorkspaceController::class, 'restore'])->withTrashed();

    Route::post('/create-board', [BoardController::class, 'create']);
    Route::get('/edit-board/{board}', [BoardController::class, 'edit']);
    Route::put('/edit-board/{board}', [BoardController::class, 'update']);
    Route::delete('/delete-board/{board}', [BoardController::class, 'destroy'])->withTrashed();
    Route::post('/restore-board/{board}', [BoardController::class, 'restore'])->withTrashed();

    Route::post('favorite/{board}', [BoardController::class, 'favorite'])->name('favorite');
    Route::post('unfavorite/{board}', [BoardController::class, 'unfavorite'])->name('unfavorite');
        
    Route::put('/update-member-role', [MemberController::class, 'updaterole'])->name('member.role-update');
    
    Route::get('/edit-visibility/{board}', [BoardController::class, 'edit']);
    Route::put('/edit-visibility/{board}', [BoardController::class, 'updatevisibility']);

    Route::post('/schedule-create', [ScheduleController::class, 'create']);
    Route::get('/schedule-edit/{schedule}', [ScheduleController::class, 'edit']);
    Route::put('/schedule-edit/{schedule}', [ScheduleController::class, 'update']);
    Route::delete('/schedule-delete/{schedule}', [ScheduleController::class, 'destroy']);
    Route::post('/schedule-restore/{schedule}', [ScheduleController::class, 'restore'])->withTrashed();

    Route::put('/schedule/read-notification', [ScheduleController::class, 'read'])->name('notifications.read');
    
    Route::post('/task-create', [TaskController::class, 'create']);
    Route::get('/task-edit/{task}', [TaskController::class, 'edit']);
    Route::put('/task-edit/{task}', [TaskController::class, 'update']);
    Route::delete('/task-delete/{task}', [TaskController::class, 'destroy'])->withTrashed();
    Route::post('/task-restore/{task}', [TaskController::class, 'restore'])->withTrashed();
    
    Route::post('task-favorite/{task}', [TaskController::class, 'favorite'])->name('task.favorite');
    Route::post('task-unfavorite/{task}', [TaskController::class, 'unfavorite'])->name('task.unfavorite');
    
    Route::post('/schedule-component-create', [ScheduleController::class, 'create_due']);
    
    Route::post('/tasks/update-order', [TaskController::class, 'updateOrder'])->name('tasks.updateOrder');
    Route::post('/task-item-update-position', [TaskItemController:: class, 'updatePosition'])->name('taskitemUpdate');
    
    Route::post('/task-item-create', [TaskItemController::class, 'create']);
    Route::get('/task-item-edit/{taskitem}', [TaskItemController::class, 'edit']);
    Route::put('/task-item-edit/{taskitem}', [TaskItemController::class, 'update']);
    Route::delete('/task-item-delete/{taskitem}', [TaskItemController::class, 'destroy'])->withTrashed();
    Route::post('/task-item-restore/{taskitem}', [TaskItemController::class, 'restore'])->withTrashed();

    // Route::get('/get-task-item', function (Workspace $workspace, Board $board) {
    //     return redirect()->route('tasks.index', ['id' => $workspace->id])
    //     ->with(['board' => $board]);
    // })->name('taskitem.assign');
    
    Route::post('task-item-favorite/{taskitem}', [TaskItemController::class, 'favorite'])->name('task-item.favorite');
    Route::post('task-item-unfavorite/{taskitem}', [TaskItemController::class, 'unfavorite'])->name('task-item.unfavorite');
        
    Route::post('/label-create', [LabelController::class, 'create']);
    Route::get('/label-edit/{label}', [LabelController::class, 'edit']);
    Route::put('/label-edit/{label}', [LabelController::class, 'update']);
    Route::delete('/label-delete/{label}', [LabelController::class, 'destroy']);
    
    Route::post('/cover-create', [CoverController::class, 'create']);
    Route::get('/cover-edit/{cover}', [CoverController::class, 'edit']);
    Route::put('/cover-edit/{cover}', [CoverController::class, 'update']);
    
    Route::post('/check-create', [CheckController::class, 'create']);
    Route::get('/check-edit/{check}', [CheckController::class, 'edit']);
    Route::put('/check-edit/{check}', [CheckController::class, 'update']);
    Route::delete('/check-delete/{check}', [CheckController::class, 'destroy']);
        
    Route::post('/assign-check-create', [AssignCheckController::class, 'create']);
    Route::get('/assign-check-edit/{assigncheck}', [AssignCheckController::class, 'edit']);
    Route::put('/assign-check-edit/{assigncheck}', [AssignCheckController::class, 'update']);
    Route::delete('/assign-check-delete/{assigncheck}', [AssignCheckController::class, 'destroy']);
    
    Route::post('/due-date-create', [DueDateController::class, 'create']);
    Route::get('/due-date-edit/{duedate}', [DueDateController::class, 'edit']);
    Route::put('/due-date-edit/{duedate}', [DueDateController::class, 'update']);
    Route::delete('/due-date-delete/{duedate}', [DueDateController::class, 'destroy']);
    
    Route::post('/checklist-create', [ChecklistController::class, 'create']);
    Route::get('/checklist-edit/{checklist}', [ChecklistController::class, 'edit']);
    Route::put('/checklist-update', [ChecklistController::class, 'update'])->name('checklist.update');

    Route::get('/checklist-title-edit/{checklist}', [ChecklistController::class, 'title_edit']);
    Route::put('/checklist-title-edit/{checklist}', [ChecklistController::class, 'title_update']);

    Route::delete('/checklist-delete/{checklist}', [ChecklistController::class, 'destroy']);
    
    Route::post('/assign-checklist-create', [AssignChecklistController::class, 'create']);
    Route::get('/assign-checklist-edit/{assignchecklist}', [AssignChecklistController::class, 'edit']);
    Route::put('/assign-checklist-edit/{assignchecklist}', [AssignChecklistController::class, 'update']);
    Route::delete('/assign-checklist-delete/{assignchecklist}', [AssignChecklistController::class, 'destroy']);
    
    Route::post('/attachment-create', [AttachmentController::class, 'create']);
    Route::get('/attachment-edit/{attachment}', [AttachmentController::class, 'edit']);
    Route::put('/attachment-edit/{attachment}', [AttachmentController::class, 'update']);
    Route::delete('/attachment-delete/{attachment}', [AttachmentController::class, 'destroy']);
    
    Route::post('/assign-create', [AssignController::class, 'create']);
    Route::get('/assign-edit/{assign}', [AssignController::class, 'edit']);
    Route::put('/assign-edit/{assign}', [AssignController::class, 'update']);
    Route::delete('/assign-delete/{assign}', [AssignController::class, 'destroy']);
    
    Route::post('/comment-create', [CommentController::class, 'create']);
    Route::get('/comment-edit/{comment}', [CommentController::class, 'edit']);
    Route::put('/comment-edit/{comment}', [CommentController::class, 'update']);
    
    Route::post('/taskitem-member-create', [TaskitemMemberController::class, 'create']);
    Route::delete('/taskitem-member-leave/{taskitem_member}', [TaskitemMemberController::class, 'leave']);
    
    Route::get('/member-edit/{member}', [MemberController::class, 'edit']);
    Route::put('/member-edit/{member}', [MemberController::class, 'update']);
    Route::delete('/member-kick/{member}', [MemberController::class, 'kick']);
    
    Route::prefix('/workspace/{workspace}')->group(function() {
        Route::get('/settings', function(Workspace $workspace, Member $member) {
            return view('workspaces.settings', compact('workspace', 'member'));
        })->name('workspaces.settings');
    
        Route::get('/archive', function (Workspace $workspace) {
            $Archived_workspaces = Workspace::onlyTrashed()->where('id', $workspace->id)->get();
            $Archived_boards = Board::onlyTrashed()->where('workspace_id', $workspace->id)->get();
            $Archived_tasks = Task::onlyTrashed()->whereHas('board', function($q) use ($workspace) {
                $q->where('workspace_id', $workspace->id);
            })->get();
            $Archived_taskitems = TaskItem::onlyTrashed()->whereHas('tasks', function($q) use ($workspace) {
                $q->whereHas('board', function($q) use ($workspace) {
                    $q->where('workspace_id', $workspace->id);
                });
            })->get();
            $Archived_schedules = Schedule::onlyTrashed()->where('workspace_id', $workspace->id)->get();        
            return view('archive.workspace-archive', compact('Archived_workspaces', 'Archived_boards', 'Archived_tasks', 'Archived_taskitems', 'Archived_schedules', 'workspace'));
        })->name('workspace.archive');
        
        Route::get('/members', function(Workspace $workspace) {
            $members = Member::all();
            return view('workspaces.member', compact('workspace','members'));    
        })->name('members.index');
        
        Route::get('/member-details/{member}', function(Workspace $workspace, Member $member) {
            $members = Member::all();
            return view('workspaces.member-detail', compact('workspace','members', 'member'));    
        })->name('members.detail');

        Route::get('/boards', function (Workspace $workspace) {
            $boards = Board::all();
            return view('boards.index', compact('workspace', 'boards'));
        })->name('boards.index');
        
        Route::get('/schedule', function (Workspace $workspace, Request $request) {
            // dd($request->all());
            $id = $request->id ?? "";
            if ($id) {
                $schedules = Schedule::all();
                return view('schedule.index', compact('workspace', 'schedules', 'id'));
            } else {
                $schedules = Schedule::all();
                return view('schedule.index', compact('workspace', 'schedules'));
            }
        })->name('schedule.index');

        Route::get('/board-task/{board}', function ($boardId) {
            $users = User::all();
            $explodetaskBoardId = explode("board-task/", URL::current());
            $taskBoardId = $explodetaskBoardId[1];
            $schedules = Schedule::all();
            $board = Board::where('id', $taskBoardId)->with('tasks', function ($q) use ($taskBoardId) {
                $q->where('tasks.board_id', $taskBoardId)
                    ->orderBy('position', 'asc')
                    ->get();
            })->first();
            $tasks = Task::all();
            $members = Member::all();
            return view('tasks.index', compact('tasks', 'board', 'schedules', 'users', 'members'));
        })->name('tasks.index');
    });
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

    // Route::get('/db/todo', [TodoComponent::class])->name('admin.db-attendance');

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