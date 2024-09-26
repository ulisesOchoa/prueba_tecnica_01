<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private UserRepositoryInterface $repository;
    private CityRepositoryInterface $cityRepository;

    public function __construct(UserRepositoryInterface $repository, CityRepositoryInterface $cityRepository)
    {
        $this->repository = $repository;
        $this->cityRepository = $cityRepository;
    }

    public function index()
    {
        $users = $this->repository->getAll();
        $cities = $this->cityRepository->getAll();

        return view('user.user', compact( 'users', 'cities' ));
    }

    public function create()
    {
        $cities = $this->cityRepository->getAll();
        return view('user.create', compact( 'cities' ));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt('password');
        $this->repository->create($data);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $cities = $this->cityRepository->getAll();
        return view('user.edit', compact( 'cities', 'user' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        $this->repository->update($user->id, $request->validated());
        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->repository->delete($user->id);
        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
    }

    public function getBossesByUserId(User $user)
    {
        $users = $this->repository->getBossesByUserId($user->id);
        return response()->json($users);
    }

    public function export(User $user)
    {
        // Nota: No se alcanzó a terminar la implementación de esta parte.
    }
}
