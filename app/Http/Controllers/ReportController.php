<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::orderByRaw('working_day desc, site_name asc, user_id asc')
            ->with('user')
            ->paginate(10);
        return  view('report.index', compact('reports'));
    }

    public function show(Report $report)
    {
        return view('report.show', compact('report'));
    }
}
