<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('project_details')->insert([
            [
                'id' => 13,
                'text' => 'Project #1',
                'start_date' => '2017-04-01 00:00:00',
                'duration' => 5,
                'progress' => 0.8,
                'parent' => 0,
                'project_id' => 2
            ],
            [
                'id' => 14,
                'text' => 'Task #1',
                'start_date' => '2017-04-06 00:00:00',
                'duration' => 4,
                'progress' => 0.5,
                'parent' => 1,
                'project_id' => 2
            ]
        ]);
    }
}
