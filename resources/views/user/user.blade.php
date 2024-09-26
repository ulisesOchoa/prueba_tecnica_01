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
                        <div>
                            <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
                            <a href="{{ route('users.export') }}" class="btn btn-success">Download Excel</a>
                        </div>
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
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#addPositionModal{{ $user->id }}" onclick="loadAvailablePositions({{ $user->id }})">
                                            Add Position
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="addPositionModal{{ $user->id }}" tabindex="-1" aria-labelledby="addPositionModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addPositionModalLabel">Add Position for {{ $user->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="loadingSpinner{{ $user->id }}" class="text-center" style="display: none;">
                                                    <div class="spinner-border" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                                <form id="positionForm{{ $user->id }}" onsubmit="event.preventDefault(); submitPositionForm({{ $user->id }});">
                                                    <div class="mb-3">
                                                        <label for="position{{ $user->id }}" class="form-label">Position</label>
                                                        <select class="form-select" id="position{{ $user->id }}" name="position" required disabled>
                                                            <option value="">Select a position</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary" id="submitBtn{{ $user->id }}" disabled>Add Position</button>
                                                </form>
                                                <div id="successMessage{{ $user->id }}" class="alert alert-success mt-3" style="display: none;">Position added successfully!</div>
                                                <div id="errorMessage{{ $user->id }}" class="alert alert-danger mt-3" style="display: none;">An error occurred while adding the position.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function loadAvailablePositions(userId) {
            const select = document.getElementById(`position${userId}`);
            const loadingSpinner = document.getElementById(`loadingSpinner${userId}`);
            const submitBtn = document.getElementById(`submitBtn${userId}`);

            select.innerHTML = '<option value="">Select a position</option>';
            loadingSpinner.style.display = 'block';
            select.disabled = true;

            axios.get(`/employeepositions/${userId}/available-positions`)
                .then(response => {
                    response.data.forEach(position => {
                        const option = document.createElement('option');
                        option.value = position.id;
                        option.textContent = position.name;
                        select.appendChild(option);
                    });
                    loadingSpinner.style.display = 'none';
                    select.disabled = false;
                    submitBtn.disabled = false;
                })
                .catch(error => {
                    console.error('Error:', error);
                    loadingSpinner.style.display = 'none';
                });
        }

        function submitPositionForm(userId) {
            const positionId = document.getElementById(`position${userId}`).value;
            const successMessage = document.getElementById(`successMessage${userId}`);
            const errorMessage = document.getElementById(`errorMessage${userId}`);
            const loadingSpinner = document.getElementById(`loadingSpinner${userId}`);

            successMessage.style.display = 'none';
            errorMessage.style.display = 'none';

            if (positionId) {
                loadingSpinner.style.display = 'block';
                axios.post('/employeepositions', {
                    user_id: userId,
                    position_id: positionId
                })
                    .then(response => {
                        successMessage.style.display = 'block';
                    })
                    .catch(error => {
                        errorMessage.style.display = 'block';
                    })
                    .then(() => loadingSpinner.style.display = 'none');
            } else {
                alert('Please select a position.');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection
