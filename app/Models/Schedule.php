<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'work_details',
        'working_day',
    ];

    public function sites()
    {
        return $this->hasMany(Site::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
