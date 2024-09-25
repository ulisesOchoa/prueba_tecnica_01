<?php

namespace App\Repositories;

use App\Interfaces\CityRepositoryInterface;
use App\Models\City;
use Illuminate\Database\Eloquent\Collection;

class CityRepository implements CityRepositoryInterface
{

    public function getAll(): Collection
    {
        return City::all();
    }

    public function getById(int $id): ?City
    {
        return City::find($id);
    }

    public function create(array $data): bool
    {
        $model = City::create($data);
        return $model->id;
    }

    public function update(int $id, array $data): bool
    {
        $model = City::findOrFail($id);
        return $model->update($data);
    }

    public function delete(int $id): bool
    {
        return City::destroy($id);
    }
}
