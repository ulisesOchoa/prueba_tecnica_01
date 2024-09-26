<form id="user-form" action="{{ $isUpdate ? route('users.update', $user->id) : route('users.store') }}" method="POST">
    @csrf
    @if($isUpdate)
        @method('PUT')
    @endif

    <div class="container">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                       name="name" value="{{ old('name', $user->name ?? '') }}" required>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="last_name" class="form-label">{{ __('Last Name') }}</label>
                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                       name="last_name" value="{{ old('last_name', $user->last_name ?? '') }}" required>
                @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="identification" class="form-label">{{ __('Identification') }}</label>
                <input id="identification" type="text"
                       class="form-control @error('identification') is-invalid @enderror"
                       name="identification" value="{{ old('identification', $user->identification ?? '') }}" required>
                @error('identification')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">{{ __('Phone') }}</label>
                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                       name="phone" value="{{ old('phone', $user->phone ?? '') }}" required>
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="city_id" class="form-label">{{ __('City ID') }}</label>
                <select id="city_id" class="form-select @error('city_id') is-invalid @enderror" name="city_id" required>
                    <option value="">{{ __('Select a city') }}</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}" {{ (old('city_id', $user->city_id ?? '') == $city->id) ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
                @error('city_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="departamento_id" class="form-label">{{ __('Department ID') }}</label>
                <select id="departamento_id" class="form-select @error('departamento_id') is-invalid @enderror"
                        name="departamento_id" required disabled>
                    <option value="">{{ __('Select a department') }}</option>
                </select>
                @error('departamento_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <button type="button" id="submit-btn" class="btn btn-primary">
                {{ $isUpdate ? __('Update') : __('Create') }}
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                {{ __('Cancel') }}
            </button>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const citySelect = document.getElementById('city_id');
        const departmentSelect = document.getElementById('departamento_id');
        const submitBtn = document.getElementById('submit-btn');
        const form = document.getElementById('user-form');

        citySelect.addEventListener('change', async function () {
            const cityId = this.value;
            departmentSelect.innerHTML = '<option value="">{{ __('Select a department') }}</option>';
            departmentSelect.disabled = true;

            if (cityId) {
                axios.get(`/departments/${cityId}/city`)
                    .then((response) => {
                        const data = response.data;
                        data.forEach(department => {
                            const option = document.createElement('option');
                            option.value = department.id;
                            option.textContent = department.name;
                            departmentSelect.appendChild(option);
                        });
                        departmentSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error fetching departments:', error);
                    });
            }
        });

        submitBtn.addEventListener('click', function () {
            const formData = new FormData(form);

            axios.post(form.action, formData)
                .then(response => {
                    window.location.href = response.data.redirect;
                })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        const errors = error.response.data.errors;
                        for (const key in errors) {
                            const input = document.querySelector(`[name="${key}"]`);
                            const feedback = input.parentNode.querySelector('.invalid-feedback');
                            input.classList.add('is-invalid');
                            feedback.textContent = errors[key][0];
                            feedback.style.display = 'block';
                        }
                    }
                });
        });
    });
</script>
