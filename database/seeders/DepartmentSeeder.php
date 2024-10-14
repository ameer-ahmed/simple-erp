<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::query()->create([
            'name' => 'Management'
        ]);

        Department::query()->create([
            'name' => 'Human Resources'
        ]);

        Department::query()->create([
            'name' => 'Marketing'
        ]);

        Department::query()->create([
            'name' => 'Finance'
        ]);

        Department::query()->create([
            'name' => 'Sales'
        ]);
    }
}
