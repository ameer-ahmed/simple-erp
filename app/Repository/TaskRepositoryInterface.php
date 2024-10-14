<?php

namespace App\Repository;

interface TaskRepositoryInterface extends RepositoryInterface
{
    public function getByManager($managerId);

    public function searchByManager($managerId, $keyword);

    public function firstByManager($id, $managerId);

    public function deleteFirstByManager($id, $managerId);

    public function searchByEmployee($employeeId, $keyword);

    public function updateStatusByEmployee($id, $employeeId, $status);

}
