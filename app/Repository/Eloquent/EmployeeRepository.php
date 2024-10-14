<?php

namespace App\Repository\Eloquent;

use App\Models\Employee;
use App\Repository\EmployeeRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class EmployeeRepository extends Repository implements EmployeeRepositoryInterface
{
    protected Model $model;

    public function __construct(Employee $model)
    {
        parent::__construct($model);
    }

    public function getByManager($managerId)
    {
        return $this->model::query()->where('manager_id', $managerId)->paginate(10);
    }

    public function searchByManager($managerId, $keyword)
    {
        return $this->model::query()
            ->where(function ($query) use ($keyword) {
                $query->when($keyword !== null, function ($query) use ($keyword) {
                    $query->where('first_name', 'like', "%$keyword%");
                    $query->orWhere('last_name', 'like', "%$keyword%");
                    $query->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$keyword%"]);
                    $query->orWhere('email', 'like', "%$keyword%");
                    $query->orWhere('phone', "$keyword");
                    $query->orWhere('salary', "$keyword");
                    $query->orWhere(function ($query) use ($keyword) {
                        $query->whereHas('tasks', function ($query) use ($keyword) {
                            $query->where('title', 'like', "%$keyword%");
                        });
                    });
                });
            })
            ->where('manager_id', $managerId)
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    public function firstByManager($id, $managerId)
    {
        return $this->model::query()->where('id', $id)->where('manager_id', $managerId)->firstOrFail();
    }

    public function deleteFirstByManager($id, $managerId)
    {
        return $this->model::query()->where('id', $id)->where('manager_id', $managerId)->firstOrFail()?->delete();
    }
}
