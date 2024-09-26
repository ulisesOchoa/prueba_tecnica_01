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
                        <span>{{ __('Users') }}</span>
                        <a href="{{ route('users.create') }}" class="btn btn-primary">
                            Create User
                        </a>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">
                            Create User on modal
                        </button>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" id="selectAll"></th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Identification</th>
                                <th scope="col">Address</th>
                                <th scope="col">Phone</th>
                                <th scope="col">City</th>
                                <th scope="col">Is Boss</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><input type="checkbox" class="selectUser" value="{{ $user->id }}"></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->identification }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->city->name }}</td>
                                    <td>{{ $user->is_boss ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                              style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal title="Título del Modal" >
        <x-user.form :cities="$cities"/>
    </x-modal>


@endsection

@section('scripts')
    <script>
        function editUser(user) {
            // const modal = new bootstrap;

            console.log(user)
        }


    </script>
@endsection

