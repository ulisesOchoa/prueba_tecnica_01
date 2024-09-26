<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{

    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function index()
    {
        $employees = $this->repository->getAll();
        return view('user.user', compact('employees'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Employe $employe)
    {
        //
    }

    public function edit(Employe $employe)
    {
        //
    }

    public function update(Request $request, Employe $employe)
    {
        //
    }

    public function destroy(Employe $employe)
    {
        //
    }
}
