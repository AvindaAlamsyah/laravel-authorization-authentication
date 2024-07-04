@extends('internal.layouts.app')

@section('title', 'Edit Role')

@section('breadcrumb')
    <li class="breadcrumb-item">Master</li>
    <li class="breadcrumb-item">Role</li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Create Exist Role</h5>

                <form class="row g-3 needs-validation" id="form-role" action="{{ route('role.update', $role->id) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <label class="form-label" for="role">Role</label>
                        <input class="form-control @error('role') is-invalid @enderror" id="role" name="role" type="text"
                               value="{{ old('role', $role->name) }}" maxlength="50" required>
                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label @error('permissions') is-invalid @enderror" for="permissions">Permission</label>
                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-3">
                                    <div class="form-check">
                                        <input class="form-check-input" id="permissions_{{ $permission->id }}" name="permissions[]" type="checkbox"
                                               value="{{ $permission->name }}"
                                               {{ in_array($permission->id, array_column($rolePermissions->toArray(), 'id')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="permissions_{{ $permission->id }}">
                                            {{ Str::headline($permission->name) }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('permissions')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
