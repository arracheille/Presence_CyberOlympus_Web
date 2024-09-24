<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function adminDashboard()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $schedules = Schedule::whereBetween('start', [$startOfWeek, $endOfWeek])->get();
        return view('admin.dashboard', compact('schedules'));
    }

    public function superadminDashboard()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $schedules = Schedule::whereBetween('start', [$startOfWeek, $endOfWeek])->get();
        return view('superadmin.dashboard', compact('schedules'));
    }

    public function index()
    {
        $boards = Board::all();
        return view('home.index', ['boards' => $boards]);
    }
}
