<?php

namespace App\Livewire\Employee\Task;

use App\Repository\TaskRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $statuses = [];

    public $keyword = null;

    private TaskRepositoryInterface $taskRepository;

    public function boot(
        TaskRepositoryInterface $taskRepository,
    )
    {
        $this->taskRepository = $taskRepository;
    }

    public function render()
    {
        $tasks = $this->taskRepository->searchByEmployee(auth('employee')->id(), $this->keyword);

        foreach ($tasks as $task) {
            $this->statuses[$task->id] = $task->status;
        }

        return view('livewire.employee.task.index', compact('tasks'));
    }

    public function updateStatus($id)
    {
        $this->taskRepository->updateStatusByEmployee($id, auth('employee')->id(), $this->statuses[$id]);

        $this->statuses = null;
    }
}
