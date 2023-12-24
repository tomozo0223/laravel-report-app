<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reports')->insert([
            'site_name' => '歩道橋',
            'user_id' => User::factory()->create()->id,
            'image_path' => '',
            'body' => '今日は剥離剤の塗布です',
            'working_day' => Carbon::now()->format('Y-m-d'),
            'start_time' => Carbon::now()->format('Y-m-d H:i:s'),
            'end_time' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('reports')->insert([
            'site_name' => '無名橋',
            'user_id' => User::factory()->create()->id,
            'image_path' => '',
            'body' => '今日はケレンです',
            'working_day' => Carbon::now()->format('Y-m-d'),
            'start_time' => Carbon::now()->format('Y-m-d H:i:s'),
            'end_time' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('reports')->insert([
            'site_name' => '新築',
            'user_id' => User::factory()->create()->id,
            'image_path' => '',
            'body' => '今日は新築の内装です',
            'working_day' => Carbon::now()->format('Y-m-d'),
            'start_time' => Carbon::now()->format('Y-m-d H:i:s'),
            'end_time' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
