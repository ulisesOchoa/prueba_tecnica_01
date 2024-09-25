<?php

namespace App\Repositories;

use App\Interfaces\EmployeRepositoryInterface;
use App\Models\Employe;
use Illuminate\Database\Eloquent\Collection;

class EmployeRepository implements EmployeRepositoryInterface
{

    public function getAll(): Collection
    {
        return Employe::all();
    }

    public function getById(int $id): ?Employe
    {
        return Employe::find($id);
    }

    public function create(array $data): bool
    {
        $model = Employe::create($data);
        return $model->id;
    }

    public function update(int $id, array $data): bool
    {
        $model = Employe::findOrFail($id);
        return $model->update($data);
    }

    public function delete(int $id): bool
    {
        return Employe::destroy($id);
    }
}
