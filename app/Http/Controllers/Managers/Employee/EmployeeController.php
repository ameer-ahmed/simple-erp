<?php

namespace App\Http\Controllers\Managers\Employee;

use App\Http\Controllers\Controller;
use App\Repository\EmployeeRepositoryInterface;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(
        private readonly EmployeeRepositoryInterface $employeeRepository,
    )
    {
    }

    public function index()
    {
        abort_if(auth('manager')->user()->is_stakeholder, 404);

        return view('dashboard.manager.employees.index');
    }

    public function create()
    {
        abort_if(auth('manager')->user()->is_stakeholder, 404);

        return view('dashboard.manager.employees.create');
    }

    public function edit(string $id)
    {
        abort_if(auth('manager')->user()->is_stakeholder, 404);

        return view('dashboard.manager.employees.edit', compact('id'));
    }
}
