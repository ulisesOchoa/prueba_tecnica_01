<?php

namespace App\Interfaces;

use App\Models\Position;
use Illuminate\Database\Eloquent\Collection;

interface PositionRepositoryInterface
{
    public function getAll() : Collection;

    public function getById(int $id) : ?Position;

    public function create(array $data) : bool;

    public function update(int $id, array $data) : bool;

    public function delete(int $id) : bool;
}
