<?php

namespace App\Repository;

interface DepartmentRepositoryInterface extends RepositoryInterface
{
    public function searchByStakeholder($keyword);

    public function destroyByStakeholder($id);
}
