<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $schedules = Schedule::whereBetween('start', [$startOfWeek, $endOfWeek])->get();
        return view('dashboard', compact('schedules'));
    }
}
