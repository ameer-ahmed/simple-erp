<?php

namespace App\Repository\Eloquent;

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
}
