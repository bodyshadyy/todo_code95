<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ToDoList;
use App\Models\Task;
use App\Models\PomodoroSettings;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        ToDoList::factory(2)->create([
            'user_id' => 1,
        ]);
        Task::factory(5)->create([
            'to_do_list_id' => 1,
        ]);
        PomodoroSettings::factory(1)->create([
            'user_id' => 1,
        ]); 


        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
