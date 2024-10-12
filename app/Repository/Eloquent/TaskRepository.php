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
}
