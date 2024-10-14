<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Manager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $managers = Manager::all();
        $salaries = [10000, 8800, 7000, 15000, 20000];

        foreach ($managers as $i => $manager) {
            if ($i == 0) {
                continue;
            }
            $salary = $salaries[array_rand($salaries)];

            Employee::query()->create([
                'manager_id' => $manager->id,
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'email' => "employee$i@mail.com",
                'phone' => "20100000000$i",
                'password' => "Employee$i@0!#", // Employee0@0!#
                'salary' => $salary,
                'image' => fake()->imageUrl(width: 600, height: 600, randomize: false, word: 'Employee'),
            ]);
        }
    }
}
