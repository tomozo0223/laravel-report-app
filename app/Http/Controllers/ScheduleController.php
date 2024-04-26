<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['site', 'users'])->paginate(10);

        return view('schedule.index', compact('schedules'));
    }

    public function create()
    {
        $users = User::all();
        return view('schedule.create', compact('users'));
    }
}
