<?php

namespace App\Livewire\Manager\Employee;

use App\Http\Services\Mutual\FileManagerService;
use App\Repository\EmployeeRepositoryInterface;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $action;
    public $id;
    private $employee = null;

    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $password;
    public $password_confirmation;
    public $salary;
    public $image;

    private EmployeeRepositoryInterface $employeeRepository;
    private FileManagerService $fileManagerService;

    public function boot(
        EmployeeRepositoryInterface $employeeRepository,
        FileManagerService $fileManagerService,
    )
    {
        $this->employeeRepository = $employeeRepository;
        $this->fileManagerService = $fileManagerService;
    }

    public function mount($action, $id = null)
    {
        $this->action = $action;
        $this->id = $id;
        $this->renderEmployee();
    }

    public function renderEmployee()
    {
        if ($this->id !== null) {
            $this->employee = $this->employeeRepository->firstByManager($this->id, auth('manager')->id());
            $this->first_name = $this->employee->first_name;
            $this->last_name = $this->employee->last_name;
            $this->email = $this->employee->email;
            $this->phone = $this->employee->phone;
            $this->salary = $this->employee->salary;
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email:rfc,dns', Rule::unique('employees', 'id')->ignore($this->id)],
            'phone' => ['required', 'numeric', 'min:8'],
            'password' => [$this->id ? 'nullable' : 'required', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed'],
            'salary' => ['required', 'numeric', 'gt:0'],
            'image' => [$this->id ? 'nullable' : 'required', 'image', 'max:2048', 'mimes:jpg,jpeg,png']
        ]);

        $validated['manager_id'] = auth('manager')->id();
        if ($this->image == null) {
            unset($validated['image']);
        } else {
            $validated['image'] = 'storage/'.$this->image->storeAs('employees', 'employee-'.time().random_int(1,1000)).'.'.$this->image->getClientOriginalExtension();
        }

        if ($this->id !== null) {
            if ($validated['password'] == null) {
                unset($validated['password']);
            }

            $this->employeeRepository->update($this->id, $validated);
        } else {
            $this->employeeRepository->create($validated);
        }

        return redirect()->route('manager.employees.index')->with('success', 'Success');
    }

    public function render()
    {
        return view('livewire.manager.employee.form');
    }
}

