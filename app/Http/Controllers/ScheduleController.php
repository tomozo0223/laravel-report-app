<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleStoreRequest;
use App\Http\Requests\ScheduleUpdateRequest;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Site;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::orderBy('working_day', 'desc')
            ->join('sites', 'schedules.site_id', '=', 'sites.id')
            ->select('schedules.*', 'schedules.id as schedule_id')
            ->orderBy('sites.name', 'desc')
            ->with(['site', 'users' => function (Builder $query) {
                $query->orderBy('id', 'asc');
            }])
            ->paginate(10);

        return view('schedule.index', compact('schedules'));
    }

    public function create()
    {
        $users = User::all();
        $sites = Site::all();
        return view('schedule.create', compact('users', 'sites'));
    }

    public function store(ScheduleStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $schedule = Schedule::create([
                'site_id' => $request->site_id,
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
        $sites = Site::all();
        return view('schedule.edit', compact('schedule', 'users', 'sites'));
    }

    public function update(ScheduleUpdateRequest $request, Schedule $schedule)
    {
        DB::transaction(function () use ($request, $schedule) {
            $schedule->site_id = $request->input('site_id');
            $schedule->site->save();

            $schedule->work_details = $request->input('work_details');
            $schedule->working_day = $request->input('working_day');
            $schedule->save();

            $schedule->users()->sync($request->input('member_id'));
        });

        return redirect()->route('schedule.show', $schedule)->with('message', '予定を更新しました。');
    }

    public function destroy(Schedule $schedule)
    {
        DB::transaction(function () use ($schedule) {
            $schedule->users()->detach();
            $schedule->delete();
        });
        return redirect()->route('schedule.index')->with('message', '予定を削除しました。');
    }
}
