<?php

namespace App\Livewire\Manager\Department;

use App\Repository\DepartmentRepositoryInterface;
use Livewire\Component;

class Form extends Component
{

    public $action;
    public $id;
    private $department = null;

    public $name;

    private DepartmentRepositoryInterface $departmentRepository;

    public function boot(
        DepartmentRepositoryInterface $departmentRepository,
    )
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function mount($action, $id = null)
    {
        $this->action = $action;
        $this->id = $id;
        $this->renderDepartment();
    }

    public function renderDepartment()
    {
        if ($this->id !== null) {
            $this->department = $this->departmentRepository->getById($this->id);
            $this->name = $this->department->name;
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => ['required', 'string'],
        ]);

        if ($this->id !== null) {
            $this->departmentRepository->update($this->id, $validated);
        } else {
            $this->departmentRepository->create($validated);
        }

        return redirect()->route('manager.departments.index')->with('success', 'Success');
    }

    public function render()
    {
        return view('livewire.manager.department.form');
    }
}

