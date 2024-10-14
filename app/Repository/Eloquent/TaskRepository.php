<?php

namespace App\Repository\Eloquent;

use App\Models\Task;
use App\Repository\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class TaskRepository extends Repository implements TaskRepositoryInterface
{
    protected Model $model;

    public function __construct(Task $model)
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
                    $query->where('title', 'like', "%$keyword%");
                    $query->orWhere('description', 'like', "%$keyword%");
                    $query->orWhere('status', "$keyword");
                    $query->orWhere(function ($query) use ($keyword) {
                        $query->whereHas('employee', function ($query) use ($keyword) {
                            $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$keyword%"]);
                            $query->orWhere('first_name', 'like', "%$keyword%");
                            $query->orWhere('last_name', 'like', "%$keyword%");
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

    public function searchByEmployee($employeeId, $keyword)
    {
        return $this->model::query()
            ->where(function ($query) use ($keyword) {
                $query->when($keyword !== null, function ($query) use ($keyword) {
                    $query->where('title', 'like', "%$keyword%");
                    $query->orWhere('description', 'like', "%$keyword%");
                    $query->orWhere('status', "$keyword");
                    $query->orWhere(function ($query) use ($keyword) {
                        $query->whereHas('manager', function ($query) use ($keyword) {
                            $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$keyword%"]);
                            $query->orWhere('first_name', 'like', "%$keyword%");
                            $query->orWhere('last_name', 'like', "%$keyword%");
                        });
                    });
                });
            })
            ->where('employee_id', $employeeId)
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    public function updateStatusByEmployee($id, $employeeId, $status)
    {
        return $this->model::query()->where('id', $id)->where('employee_id', $employeeId)->firstOrFail()?->update([
            'status' => $status
        ]);
    }


}
