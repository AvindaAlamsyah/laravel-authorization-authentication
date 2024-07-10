@extends('internal.layouts.app')

@section('title', 'Account Setting')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Account Information</h5>

                <form class="needs-validation" id="form-user" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PATCH')

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label" for="name">Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text"
                                   value="{{ old('name', $user->name) }}" maxlength="50" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email"
                                   value="{{ old('email', $user->email) }}" maxlength="50" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-md-between">
                                <img class="img-fluid rounded m-2" src="{{ asset('storage/uploads/' . $user->avatar) }}" alt="avatar"
                                     style="max-width: 100px">
                                <div class="col-md-10">
                                    <label class="form-label" for="avatar">Avatar</label>
                                    <input class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" type="file">
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Password</h5>

                <form class="needs-validation" id="form-user" action="{{ route('password.update') }}" method="POST" enctype="multipart/form-data"
                      novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="row-12">
                            <label class="form-label" for="current_password">Current Password</label>
                            <input class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" type="password" required>
                            @error('current_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
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

                        <div class="text-end">
                            <button class="btn btn-primary" type="submit">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
