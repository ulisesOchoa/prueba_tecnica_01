<?php

namespace App\Interfaces;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

interface CountryRepositoryInterface
{
    public function getAll() : Collection;

    public function getById(int $id) : ?Country;

    public function create(array $data) : bool;

    public function update(int $id, array $data) : bool;

    public function delete(int $id) : bool;
}
