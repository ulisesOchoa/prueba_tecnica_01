<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Models\EmployePosition;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployePositionController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'position_id' => 'required|exists:positions,id',
        ]);

        try {
            EmployePosition::create([
                'user_id' => $request->input('user_id'),
                'position_id' => $request->input('position_id'),
            ]);

            return response()->json(['success' => true, 'message' => 'Posición asignada exitosamente.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Hubo un problema asignando la posición.'], 500);
        }
    }

    public function getAvailablePositions($userId)
    {
        $user = $this->userRepository->getById($userId);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $positions = Position::from('positions as p')
            ->select([
                'p.id',
                'p.name'
            ])
            ->leftJoin('employees_positions as ep', function($join) use ($user) {
                $join->on('p.id', '=', 'ep.position_id')
                    ->where('ep.user_id', '=', $user->id);
            })
            ->whereNull('ep.user_id')
            ->get();

        return response()->json($positions);
    }
}
