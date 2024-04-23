<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'site_id' => Site::first()->id,
            'work_details' => fake()->realText(30),
            'working_day' => Carbon::now(),
        ];
    }
}
