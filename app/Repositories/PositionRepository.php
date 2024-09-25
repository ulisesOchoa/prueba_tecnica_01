<?php

namespace App\Repositories;

use App\Interfaces\PositionRepositoryInterface;
use App\Models\Position;
use Illuminate\Database\Eloquent\Collection;

class PositionRepository implements PositionRepositoryInterface
{

    public function getAll(): Collection
    {
        return Position::all();
    }

    public function getById(int $id): ?Position
    {
        return Position::find($id);
    }

    public function create(array $data): bool
    {
        $model = Position::create($data);
        return $model->id;
    }

    public function update(int $id, array $data): bool
    {
        $model = Position::findOrFail($id);
        return $model->update($data);
    }

    public function delete(int $id): bool
    {
        return Position::destroy($id);
    }
}
