<?php

namespace App\Interfaces;

use App\Models\City;
use Illuminate\Database\Eloquent\Collection;

interface CityRepositoryInterface
{
    public function getAll() : Collection;

    public function getById(int $id) : ?City;

    public function create(array $data) : bool;

    public function update(int $id, array $data) : bool;

    public function delete(int $id) : bool;
}
