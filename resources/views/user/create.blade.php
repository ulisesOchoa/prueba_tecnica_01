@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Crear Usuario</h2>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror @if(old('name') && !$errors->has('name')) is-valid @endif" value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">Apellidos</label>
                    <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror @if(old('last_name') && !$errors->has('last_name')) is-valid @endif" value="{{ old('last_name') }}">
                    @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror @if(old('email') && !$errors->has('email')) is-valid @endif" value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="identification">Identificación</label>
                    <input type="text" name="identification" id="identification" class="form-control @error('identification') is-invalid @enderror @if(old('identification') && !$errors->has('identification')) is-valid @endif" value="{{ old('identification') }}">
                    @error('identification')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Teléfono</label>
                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror @if(old('phone') && !$errors->has('phone')) is-valid @endif" value="{{ old('phone') }}">
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="city_id">Ciudad</label>
                    <select name="city_id" id="city_id" class="form-control @error('city_id') is-invalid @enderror" onchange="loadDepartments(this.value)">
                        <option value="">Seleccionar ciudad</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                    @error('city_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="department_id">Departamento</label>
                    <select name="department_id" id="department_id" class="form-control @error('department_id') is-invalid @enderror" disabled>
                        <option value="">Seleccionar departamento</option>
                    </select>
                    @error('department_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span id="loading" class="text-info" style="display:none;">Cargando departamentos...</span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-4">Crear Usuario</button>
        </form>
    </div>

    <script>
        function loadDepartments(cityId) {
            const departmentSelect = document.getElementById('department_id');
            const loadingText = document.getElementById('loading');
            departmentSelect.innerHTML = '<option value="">Seleccionar departamento</option>';
            departmentSelect.disabled = true;
            loadingText.style.display = 'inline';

            if (cityId) {
                fetch(`/departments/${cityId}/city`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(department => {
                            departmentSelect.innerHTML += `<option value="${department.id}">${department.name}</option>`;
                        });
                        departmentSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error al cargar los departamentos:', error);
                    })
                    .finally(() => {
                        loadingText.style.display = 'none';
                    });
            } else {
                departmentSelect.disabled = true;
                loadingText.style.display = 'none';
            }
        }
    </script>

@endsection
