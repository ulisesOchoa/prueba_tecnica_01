<?php

namespace App\Interfaces;

use App\Models\Employe;
use Illuminate\Database\Eloquent\Collection;

interface EmployeRepositoryInterface
{
    public function getAll() : Collection;

    public function getById(int $id) : ?Employe;

    public function create(array $data) : bool;

    public function update(int $id, array $data) : bool;

    public function delete(int $id) : bool;
}
