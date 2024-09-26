@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Asignar encargado</h2>
        <form action="{{ route('positions.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="user_id">User</label>
                    <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" onchange="loadBosses(this.value); loadPositions(this.value)">
                        <option value="">Select User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->identification }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="position_id">Position</label>
                    <select name="position_id" id="position_id" class="form-control @error('position_id') is-invalid @enderror" disabled>
                        <option value="">Select Position</option>
                    </select>
                    @error('position_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span id="loadingPositions" class="text-info" style="display:none;">Loading positions...</span>
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <input type="text" name="role" id="role" class="form-control @error('role') is-invalid @enderror @if(old('role') && !$errors->has('role')) is-valid @endif" value="{{ old('role') }}">
                    @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="boss_id">Boss</label>
                    <select name="boss_id" id="boss_id" class="form-control @error('boss_id') is-invalid @enderror" disabled>
                        <option value="">Select Boss</option>
                    </select>
                    @error('boss_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span id="loadingBosses" class="text-info" style="display:none;">Loading bosses...</span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-4">Create User</button>
        </form>
    </div>

    <script>
        function loadBosses(userId) {
            const bossSelect = document.getElementById('boss_id');
            const loadingText = document.getElementById('loadingBosses');
            bossSelect.innerHTML = '<option value="">Select Boss</option>';
            bossSelect.disabled = true;
            loadingText.style.display = 'inline';

            if (userId) {
                fetch(`/users/${userId}/bosses-by-id`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(boss => {
                            bossSelect.innerHTML += `<option value="${boss.id}">${boss.name} (${boss.identification})</option>`;
                        });
                        bossSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error loading bosses:', error);
                    })
                    .finally(() => {
                        loadingText.style.display = 'none';
                    });
            } else {
                bossSelect.disabled = true;
                loadingText.style.display = 'none';
            }
        }

        function loadPositions(userId) {
            const positionSelect = document.getElementById('position_id');
            const loadingText = document.getElementById('loadingPositions');
            positionSelect.innerHTML = '<option value="">Select Position</option>';
            positionSelect.disabled = true;
            loadingText.style.display = 'inline';

            if (userId) {
                fetch(`/employeepositions/${userId}/available-positions`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(position => {
                            positionSelect.innerHTML += `<option value="${position.id}">${position.name}</option>`;
                        });
                        positionSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error loading positions:', error);
                    })
                    .finally(() => {
                        loadingText.style.display = 'none';
                    });
            } else {
                positionSelect.disabled = true;
                loadingText.style.display = 'none';
            }
        }
    </script>
@endsection
