<?php

namespace App\Interfaces;

use App\Models\Department;
use Illuminate\Database\Eloquent\Collection;

interface DepartmentRepositoryInterface
{
    public function getAll() : Collection;

    public function getById(int $id) : ?Department;

    public function create(array $data) : bool;

    public function update(int $id, array $data) : bool;

    public function delete(int $id) : bool;

    public function getAllByCityId(int $cityId) : Collection;
}
