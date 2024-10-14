<?php

namespace App\Livewire\Manager\Employee;

use App\Repository\EmployeeRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $keyword = null;

    private EmployeeRepositoryInterface $employeeRepository;

    public function boot(
        EmployeeRepositoryInterface $employeeRepository,
    )
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function render()
    {
        $employees = $this->employeeRepository->searchByManager(auth('manager')->id(), $this->keyword);

        return view('livewire.manager.employee.index', compact('employees'));
    }

    public function destroy($id)
    {
        $this->employeeRepository->deleteFirstByManager($id, auth('manager')->id());

        return redirect()->route('manager.employees.index')->with('success', 'Success');
    }
}
