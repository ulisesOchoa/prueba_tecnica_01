<?php

namespace App\Repositories;

use App\Interfaces\CountryRepositoryInterface;
use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class CountryRepository implements CountryRepositoryInterface
{

    public function getAll(): Collection
    {
        return Country::all();
    }

    public function getById(int $id): ?Country
    {
        return Country::find($id);
    }

    public function create(array $data): bool
    {
        $model = Country::create($data);
        return $model->id;
    }

    public function update(int $id, array $data): bool
    {
        $model = Country::findOrFail($id);
        return $model->update($data);
    }

    public function delete(int $id): bool
    {
        return Country::destroy($id);
    }
}
