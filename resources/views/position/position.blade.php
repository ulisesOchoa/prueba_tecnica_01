@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>{{ __('Employees') }}</span>
                        <a href="{{ route('positions.create') }}" class="btn btn-primary">Create</a>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Identification</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Position</th>
                                <th scope="col">Role</th>
                                <th scope="col">Boss</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($positions as $position)
                                <tr>
                                    <td>{{ $position->user_name }}</td>
                                    <td>{{ $position->identification ?? '' }}</td>
                                    <td>{{ $position->brand ?? '' }}</td>
                                    <td>{{ $position->positions }}</td>
                                    <td>{{ $position->role ?? '' }}</td>
                                    <td>{{ $position->boss_name ?? '' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
