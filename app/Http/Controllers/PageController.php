<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function attendance()
    {
        //
        return view('attendance');
    }

    public function schedule()
    {
        //
        return view('schedule');
    }

    public function todo()
    {
        //
        return view('to-do');
    }

    public function dbuser()
    {
        //
        return view('admin.db-user');
    }
    
    public function dbtodo()
    {
        //
        return view('admin.db-todo');
    }
    
    public function dbschedule()
    {
        //
        return view('admin.db-schedule');
    }
    
    public function dbattendance()
    {
        //
        return view('admin.db-attendance');
    }

}
