<?php

namespace App\Http\Controllers;

use App\Http\Requests\Position\StoreRequest;
use App\Interfaces\PositionRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{

    private PositionRepositoryInterface $repository;
    private UserRepositoryInterface $userRepository;

    public function __construct(PositionRepositoryInterface $repository , UserRepositoryInterface $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $positions = $this->repository->getAll();
        return view('position.position', compact( 'positions' ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = $this->userRepository->getAll();
        return view('position.create', compact( 'users' ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $userId = $request->get('user_id');

        try {
            DB::beginTransaction();

            $this->userRepository->addPositionToUser($userId, $data);
            $this->userRepository->update($userId, ['boss_id' => $data['boss_id']]);
            DB::commit();
            return redirect()->route('positions.index')->with('success', 'Registro actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Hubo un error al actualizar el registro.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        //
    }
}
