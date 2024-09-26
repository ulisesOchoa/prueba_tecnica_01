<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\EmployePosition;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{

    public function getAll(): Collection
    {
        return User::with('city')->get();
    }

    public function getById(int $id): ?User
    {
        return User::find($id);
    }

    public function create(array $data): bool
    {
        $model = User::create($data);
        return $model->id;
    }

    public function update(int $id, array $data): bool
    {
        $model = User::findOrFail($id);
        return $model->update($data);
    }

    public function delete(int $id): bool
    {
        $user = User::withTrashed()->find($id);

        if ($user) {
            if ($user->trashed()) {
                return $user->forceDelete();
            } else {
                return $user->delete();
            }
        }

        return false;
    }

    public function getBossesByUserId(int $id): Collection
    {
        return User::where('id', '!=', $id)->get();
    }

    public function addPositionToUser(int $id, array $data): bool
    {
        EmployePosition::create([
            'role' => $data['role'],
            'user_id' => $data['user_id'],
            'position_id' => $data['position_id'],
        ]);

        return true;
    }
}
