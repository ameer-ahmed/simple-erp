<?php

namespace App\Livewire\Manager\Department;

use App\Repository\DepartmentRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $keyword = null;

    private DepartmentRepositoryInterface $departmentRepository;

    public function boot(
        DepartmentRepositoryInterface $departmentRepository,
    )
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function render()
    {
        $departments = $this->departmentRepository->searchByStakeholder($this->keyword);

        return view('livewire.manager.department.index', compact('departments'));
    }

    public function destroy($id)
    {
        abort_if(!auth('manager')->user()->is_stakeholder, 403);

        $this->departmentRepository->destroyByStakeholder($id);

        return redirect()->route('manager.departments.index')->with('success', 'Success');
    }
}
