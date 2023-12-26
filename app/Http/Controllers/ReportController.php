<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::orderBy('working_day', 'desc')->paginate(10);
        return  view('report.index', compact('reports'));
    }
}
