<?php

namespace App\Repository;

interface EmployeeRepositoryInterface extends RepositoryInterface
{
    public function getByManager($managerId);

    public function searchByManager($managerId, $keyword);

    public function firstByManager($id, $managerId);

    public function deleteFirstByManager($id, $managerId);
}
