<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Manager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = Department::all();

        foreach ($departments as $i => $department) {
            Manager::query()->create([
                'is_stakeholder' => $i == 0,
                'department_id' => $department->id,
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'email' => "manager$i@mail.com",
                'phone' => "20110000000$i",
                'password' => "Manager$i@0!#", // Manager0@0!#
            ]);
        }
    }
}
