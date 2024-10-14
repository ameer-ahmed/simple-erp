<?php

namespace App\Repository\Eloquent;

use App\Http\Enums\TaskStatus;
use App\Models\Department;
use App\Repository\DepartmentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class DepartmentRepository extends Repository implements DepartmentRepositoryInterface
{
    protected Model $model;

    public function __construct(Department $model)
    {
        parent::__construct($model);
    }

    public function searchByStakeholder($keyword)
    {
        return $this->model::query()
            ->where('name', 'like', "%$keyword%")
            ->whereDoesntHave('managers', function ($query) {
                $query->where('is_stakeholder', true);
            })
            ->withCount('employees')
            ->withSum('employees', 'salary')
            ->paginate(10);
    }

    public function destroyByStakeholder($id)
    {
        return $this->model::query()
            ->where('id', $id)
            ->whereDoesntHave('managers', function ($query) {
                $query->where('is_stakeholder', true);
            })
            ->whereDoesntHave('managers', function ($query) {
                $query->whereDoesntHave('tasks', function ($query) {
                    $query->where('status', '!=', TaskStatus::DONE->value);
                });
            })
            ->delete();
    }
}
