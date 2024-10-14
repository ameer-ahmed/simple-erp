<?php

namespace App\Livewire\Manager\Task;

use App\Http\Enums\TaskStatus;
use App\Repository\EmployeeRepositoryInterface;
use App\Repository\TaskRepositoryInterface;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class Form extends Component
{

    public $action;
    public $id;

    private $task = null;

    public $title;
    public $description;
    public $status;
    public $employee_id;

    private TaskRepositoryInterface $taskRepository;
    private EmployeeRepositoryInterface $employeeRepository;

    public function boot(
        TaskRepositoryInterface $taskRepository,
        EmployeeRepositoryInterface $employeeRepository,
    )
    {
        $this->taskRepository = $taskRepository;
        $this->employeeRepository = $employeeRepository;
    }

    public function mount($action, $id = null)
    {
        $this->action = $action;
        $this->id = $id;
        $this->renderTask();
    }

    public function renderTask()
    {
        if ($this->id !== null) {
            $this->task = $this->taskRepository->firstByManager($this->id, auth('manager')->id());
            $this->title = $this->task->title;
            $this->description = $this->task->description;
            $this->status = $this->task->status;
            $this->employee_id = $this->task->employee_id;
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'status' => ['required', Rule::in(TaskStatus::values())],
            'employee_id' => ['required', Rule::exists('employees', 'id')->where('manager_id', auth('manager')->id())],
        ]);


        $validated['manager_id'] = auth('manager')->id();

        if ($this->id !== null) {
            $this->taskRepository->update($this->id, $validated);
        } else {
            $this->taskRepository->create($validated);
        }

        return redirect()->route('manager.tasks.index')->with('success', 'Success');
    }

    public function render()
    {
        $employees = $this->employeeRepository->getByManager(auth('manager')->id());

        return view('livewire.manager.task.form', compact('employees'));
    }
}
