<?php

namespace App\Http\Controllers\Managers\Department;

use App\Http\Controllers\Controller;
use App\Repository\TaskRepositoryInterface;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct(
        private readonly TaskRepositoryInterface $taskRepository,
    )
    {
    }

    public function index()
    {
        abort_if(!auth('manager')->user()->is_stakeholder, 404);

        return view('dashboard.manager.departments.index');
    }

    public function create()
    {
        abort_if(!auth('manager')->user()->is_stakeholder, 404);

        return view('dashboard.manager.departments.create');
    }

    public function edit(string $id)
    {
        abort_if(!auth('manager')->user()->is_stakeholder, 404);

        return view('dashboard.manager.departments.edit', compact('id'));
    }
}
