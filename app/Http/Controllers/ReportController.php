<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportStoreRequest;
use App\Http\Requests\ReportUpdateRequest;
use App\Models\Report;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reportDate = $request->input('report_date');
        $keyword = $request->input('keyword');
        $reports = new Report();
        $reports = $reports->searchReport($reportDate,  $keyword);

        return  view('report.index', compact('reports'));
    }

    public function create()
    {
        $users = User::all();
        $sites = Site::all();
        return view('report.create', compact('users', 'sites'));
    }

    public function show(Report $report)
    {
        $report = Report::findOrFail($report->id);
        $comments = $report->comments()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('report.show', compact('report', 'comments'));
    }

    public function store(ReportStoreRequest $request)
    {
        $path = '';
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
        }

        DB::transaction(function () use ($request, $path) {
            $report = Report::create([
                'site_id' => $request->input('site_id'),
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
        $this->authorize($report);

        $users = User::all();
        $sites = Site::all();

        $reportUserId = [];
        foreach ($report->users as $user) {
            $reportUserId[] = $user->id;
        }
        return view('report.edit', compact('report', 'users', 'sites', 'reportUserId'));
    }

    public function update(ReportUpdateRequest $request, Report $report)
    {
        $this->authorize($report);

        $path = '';
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($report->image_path);
            $path = $request->file('image')->store('images', 'public');
        }
        DB::transaction(function () use ($request, $report, $path) {
            $report->site_id = $request->input('site_id');
            $report->body = $request->input('body');
            $report->image_path = $request->image ? $path : $report->image_path;
            $report->working_day = $request->input('working_day');
            $report->start_time = $request->input('start_time');
            $report->end_time = $request->input('end_time');
            $report->save();
            // 中間テーブルの変更
            $report->users()->sync($request->user_id);
        });

        return redirect()->route('report.show', $report)->with('message', '更新しました。');
    }

    public function destroy(Report $report)
    {
        DB::transaction(function () use ($report) {
            if ($report->users) {
                $report->users()->detach();
            }
            $report->delete();
        });

        if ($report->image_path) {
            Storage::disk('public')->delete($report->image_path);
        }

        return redirect()->route('report.index')->with('message', '削除しました。');
    }
}
