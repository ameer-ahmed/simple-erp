<?php

namespace Database\Seeders;

use App\Http\Enums\TaskStatus;
use App\Models\Employee;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            for ($i = 1; $i <= 4; $i++) {
                Task::query()->create([
                    'title' => fake()->text(40),
                    'description' => fake()->text(700),
                    'status' => TaskStatus::ASSIGNED->value,
                    'manager_id' => $employee->manager_id,
                    'employee_id' => $employee->id,
                ]);
            }
        }
    }
}
