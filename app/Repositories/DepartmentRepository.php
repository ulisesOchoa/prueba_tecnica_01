<?php

namespace App\Repositories;


use App\Interfaces\DepartmentRepositoryInterface;
use App\Models\Department;
use Illuminate\Database\Eloquent\Collection;

class DepartmentRepository implements DepartmentRepositoryInterface
{

    public function getAll(): Collection
    {
        return Department::all();
    }

    public function getById(int $id): ?Department
    {
        return Department::find($id);
    }

    public function create(array $data): bool
    {
        $model = Department::create($data);
        return $model->id;
    }

    public function update(int $id, array $data): bool
    {
        $model = Department::findOrFail($id);
        return $model->update($data);
    }

    public function delete(int $id): bool
    {
        return Department::destroy($id);
    }

    public function getAllByCityId(int $cityId): Collection
    {
        return Department::where('city_id', $cityId)->get();
    }
}
