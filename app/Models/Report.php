<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'user_id',
        'image_path',
        'body',
        'working_day',
        'start_time',
        'end_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function searchReport(?string $reportDate, ?string $keyword): LengthAwarePaginator
    {
        $reports = Report::when($reportDate, function (Builder $query, $reportDate) {
            $query->where('working_day', $reportDate);
        })->when($keyword, function (Builder $query, $keyword) {
            $query->where('site_name', 'LIKE', "%$keyword%");
        })->with('user')
            ->orderByRaw('working_day desc, site_name asc, user_id asc')
            ->paginate(10)
            ->appends(['report_date' => $reportDate, "keyword" => $keyword]);

        return $reports;
    }
}
