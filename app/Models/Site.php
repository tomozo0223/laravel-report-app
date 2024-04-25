<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    use HasFactory;

    public function reports()
    {
        return $this->hasMany(Reports::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
