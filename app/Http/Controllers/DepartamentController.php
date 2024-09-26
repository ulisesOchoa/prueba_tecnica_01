<?php

namespace App\Http\Controllers;

use App\Interfaces\DepartmentRepositoryInterface;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartamentController extends Controller
{
    private DepartmentRepositoryInterface $repository;

    public function __construct(DepartmentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $departments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $departments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $departments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $departments)
    {
        //
    }

    public function getCities(int $cityId)
    {
        return response()->json(
            $this->repository->getAllByCityId($cityId)
        );
    }
}
