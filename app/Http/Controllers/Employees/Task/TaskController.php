<?php

namespace App\Http\Controllers\Employees\Task;

use App\Http\Controllers\Controller;
use App\Repository\TaskRepositoryInterface;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskRepositoryInterface $taskRepository,
    )
    {
    }

    public function index()
    {
        return view('dashboard.employee.tasks.index');
    }
}
