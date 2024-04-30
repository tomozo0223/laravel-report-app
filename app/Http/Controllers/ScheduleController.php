<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleStoreRequest;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Site;
use Illuminate\Http\Request;
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
    public function show(Schedule $schedule)
    {
        $schedule = Schedule::findOrFail($schedule->id);
        return view('schedule.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        $users = User::all();
        return view('schedule.edit', compact('schedule', 'users'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        DB::transaction(function () use ($request, $schedule) {
            $schedule->site->name = $request->input('site_name');
            $schedule->site->address = $request->input('address');
            $schedule->site->save();

            $schedule->work_details = $request->input('work_details');
            $schedule->working_day = $request->input('working_day');
            $schedule->save();

            $schedule->users()->sync($request->input('member_id'));
        });

        return redirect()->route('schedule.show', $schedule)->with('message', '予定を登録しました。');
    }
}
