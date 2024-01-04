<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportStoreRequest;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::orderByRaw('working_day desc, site_name asc, user_id asc')
            ->with('user')
            ->paginate(10);
        return  view('report.index', compact('reports'));
    }

    public function create()
    {
        $users = User::all();
        return view('report.create', compact('users'));
    }

    public function show(Report $report)
    {
        return view('report.show', compact('report'));
    }

    public function store(ReportStoreRequest $request)
    {
        $path = '';
        if ($request->hasFile('image')) {
            $fileName = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images', $fileName, 'public');
        }

        DB::transaction(function () use ($request, $path) {
            $report = Report::create([
                'site_name' => $request->input('site_name'),
                'user_id' => auth()->id(),
                'image_path' => $request->image ? $path : '',
                'body' => $request->input('body'),
                'working_day' => $request->input('working_day'),
                'start_time' => $request->input('start_time'),
                'end_time' => $request->input('end_time'),
            ]);

            if ($request->user_id) {
                $report->users()->attach($request->user_id);
            }
        });
        return redirect()->route('report.index')->with('message', '日報を登録しました。');
    }

    public function edit(Report $report)
    {
        $users = User::all();
        $reportUserId = [];
        foreach ($report->users as $user) {
            $reportUserId[] = $user->id;
        }
        return view('report.edit', compact('report', 'users', 'reportUserId'));
    }
}
