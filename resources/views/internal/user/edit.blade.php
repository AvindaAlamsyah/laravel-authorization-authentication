@extends('internal.layouts.app')

@section('title', 'Edit User')

@section('breadcrumb')
    <li class="breadcrumb-item">Master</li>
    <li class="breadcrumb-item">User</li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
    <section class="section">
        <form class="needs-validation" id="form-user" action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Exist User</h5>

                    <div class=" row g-3">
                        <div class="col-8">
                            <label class="form-label" for="name">Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text"
                                   value="{{ old('name', $user->name) }}" maxlength="50" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email"
                                   value="{{ old('email', $user->email) }}" maxlength="50" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">-- Please select --</option>
                                @foreach (App\Enums\UserStatus::cases() as $status)
                                    <option value="{{ $status->value }}" @selected(old('status', $user->status) == $status->value)>{{ $status->value }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label class="form-label" for="type">Type</label>
                            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                <option value="">-- Please select --</option>
                                @foreach (App\Enums\UserType::cases() as $type)
                                    <option value="{{ $type->value }}" @selected(old('type', $user->type) == $type->value)>{{ $type->value }}</option>
                                @endforeach
                            </select>
                            @error('type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="avatar">Avatar</label>
                            <input class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" type="file">
                            <div class="form-text" id="avatar">
                                <a href="{{ asset('storage/uploads/' . $user->avatar) }}" target="_blank">Current avatar file.</a>
                            </div>
                            @error('avatar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Role</h5>

                    <div class="row">
                        @foreach ($roles as $role)
                            <div class="col-3">
                                <div class="form-check">
                                    <input class="form-check-input" id="roles_{{ $role->id }}" name="roles[]" type="checkbox"
                                           value="{{ $role->name }}"
                                           {{ in_array($role->id, array_column($userRoles->toArray(), 'id')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="roles_{{ $role->id }}">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('roles')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Update Password</h5>

                    <div class=" row g-3">
                        <div class="col-6">
                            <label class="form-label" for="password">New Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password">
                            <div class="form-text" id="avatar">Leave it blank if you don't change the password.</div>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <input class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                                   name="password_confirmation" type="password">
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body d-flex justify-content-end p-3">
                    <button class="btn btn-warning" type="submit">Update User</button>
                </div>
            </div>
        </form>
    </section>
@endsection
