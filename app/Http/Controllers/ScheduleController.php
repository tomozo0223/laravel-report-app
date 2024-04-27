<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleStoreRequest;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Site;
use Illuminate\Support\Facades\DB;

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

    public function store(ScheduleStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $site = Site::create([
                'name' => $request->site_name,
                'address' => $request->address,
            ]);

            $schedule = Schedule::create([
                'site_id' => $site->id,
                'work_details' => $request->work_details,
                'working_day' => $request->working_day,
            ]);

            $schedule->users()->attach($request->member_id);
        });


        return redirect()->route('schedule.index')->with('message', '予定を登録しました。');
    }
}
