<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteStoreRequest;
use App\Http\Requests\SiteUpdateRequest;
use App\Models\Site;

class SiteController extends Controller
{
    public function index()
    {
        $sites = Site::orderBy('created_at', 'desc')->paginate(10);
        return view('site.index', compact('sites'));
    }

    public function create()
    {
        return view('site.create');
    }

    public function store(SiteStoreRequest $request)
    {
        Site::create([
            'name' => $request->input('name'),
            'address' => $request->input('address')
        ]);

        return redirect()->route('site.index')->with('message', '現場を登録しました。');
    }

    public function edit(Site $site)
    {
        $site = Site::findOrFail($site->id);

        return view('site.edit', compact('site'));
    }

    public function update(SiteUpdateRequest $request, Site $site)
    {
        $site->name = $request->input('name');
        $site->address = $request->input('address');
        $site->save();

        return redirect()->route('site.index')->with('message', '現場を更新しました。');
    }

    public function destroy(Site $site)
    {
        if ($site->reports->isEmpty() && $site->schedules->isEmpty()) {
            $site->delete();
            return redirect()->route('site.index')->with('message', '現場を削除しました。');
        } else {
            return redirect()->route('site.index')->with('message', '現場は日報または予定に登録されているため削除できません。');
        }
    }
}
