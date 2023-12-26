<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'site_name' => fake()->word(),
            'user_id' => User::factory()->create()->id,
            'image_path' => '',
            'body' => fake()->realText(50),
            'working_day' => fake()->dateTimeBetween('2023-01-01', 'now')->format('Y-m-d'),
            'start_time' => fake()->dateTimeBetween('07:30:00', '8:30:00')->format('H:i:s'),
            'end_time' => fake()->dateTimeBetween('17:30:00', '19:30:00')->format('H:i:s'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
