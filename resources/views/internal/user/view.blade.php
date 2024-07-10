@extends('internal.layouts.app')

@section('title', 'View User')

@section('breadcrumb')
    <li class="breadcrumb-item">Master</li>
    <li class="breadcrumb-item">User</li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">View User Data</h5>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-3 label fw-bold">Name</div>
                            <div class="col-md-9">{{ $user->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 label fw-bold">Email</div>
                            <div class="col-md-9">{{ $user->email }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 label fw-bold">Avatar</div>
                            <div class="col-md-9">
                                <img class="img-fluid rounded my-2" src="{{ asset('storage/uploads/' . $user->avatar) }}" alt="avatar"
                                     style="max-width: 100px">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-3 label fw-bold">Status</div>
                            <div class="col-md-9">
                                <span class="badge bg-{{ App\Enums\UserStatus::tryFrom($user->status)->color() }}">{{ $user->status }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 label fw-bold">Type</div>
                            <div class="col-md-9">{{ $user->type }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 label fw-bold">Roles</div>
                            <div class="col-md-9 row">
                                @foreach ($userRoles as $role)
                                    <div>
                                        <i class="bi bi-check2-square"></i> {{ $role->name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 label fw-bold">Created At</div>
                            <div class="col-md-9">{{ $user->created_at->format('d F Y H:i') }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 label fw-bold">Updated At</div>
                            <div class="col-md-9">{{ $user->updated_at->format('d F Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
