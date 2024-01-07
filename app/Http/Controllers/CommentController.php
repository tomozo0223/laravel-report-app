<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Report;

class CommentController extends Controller
{
    public function store(CommentStoreRequest $request, Report $report)
    {
        Comment::create([
            'user_id' => auth()->id(),
            'report_id' => $report->id,
            'body' => $request->input('body'),
        ]);

        return redirect()->route('report.show', $report)->with('commentMessage', 'コメント投稿しました。');
    }
}
