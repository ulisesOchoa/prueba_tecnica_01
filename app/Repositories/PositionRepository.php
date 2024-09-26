<?php

namespace App\Repositories;

use App\Interfaces\PositionRepositoryInterface;
use App\Models\Position;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PositionRepository implements PositionRepositoryInterface
{

    public function getAll(): Collection
    {
        return DB::table('users as u')
            ->join('employees_positions as ep', 'u.id', '=', 'ep.user_id')
            ->join('positions as p', 'p.id', '=', 'ep.position_id')
            ->join('users as bo', 'u.id', '=', 'bo.boss_id')
            ->select([
                'u.id as user_id',
                'u.identification',
                'u.name as user_name',
                'ep.role as role',
                'bo.name as boss_name',
                DB::raw('GROUP_CONCAT(p.name, " | ") as positions')
            ])
            ->groupBy('u.id', 'u.name')
            ->get();
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
