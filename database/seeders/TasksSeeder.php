<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            ['name' => 'Task 1', 'description' => 'Description for task 1', 'image' => 'images/tasks/default.jpg'],
            ['name' => 'Task 2', 'description' => 'Description for task 2', 'image' => 'images/tasks/default.jpg'],
            ['name' => 'Task 3', 'description' => 'Description for task 3', 'image' => 'images/tasks/default.jpg'],
            ['name' => 'Task 4', 'description' => 'Description for task 4', 'image' => 'images/tasks/default.jpg'],
            ['name' => 'Task 5', 'description' => 'Description for task 5', 'image' => 'images/tasks/default.jpg'],
            ['name' => 'Task 6', 'description' => 'Description for task 6', 'image' => 'images/tasks/default.jpg'],
            ['name' => 'Task 7', 'description' => 'Description for task 7', 'image' => 'images/tasks/default.jpg'],
            ['name' => 'Task 8', 'description' => 'Description for task 8', 'image' => 'images/tasks/default.jpg'],
            ['name' => 'Task 9', 'description' => 'Description for task 9', 'image' => 'images/tasks/default.jpg'],
            ['name' => 'Task 10', 'description' => 'Description for task 10', 'image' => 'images/tasks/default.jpg']
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
