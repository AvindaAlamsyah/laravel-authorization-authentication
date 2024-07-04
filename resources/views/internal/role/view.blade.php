@extends('internal.layouts.app')

@section('title', 'View Role')

@section('breadcrumb')
    <li class="breadcrumb-item">Master</li>
    <li class="breadcrumb-item">Role</li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">View Role Data</h5>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label fw-bold">Role</div>
                    <div class="col-lg-9 col-md-8">{{ $role->name }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label fw-bold">Permissions</div>
                    <div class="col-lg-9 col-md-8 row">
                        @foreach ($rolePermissions as $item)
                            <div class="col-md-3">
                                <i class="bi bi-check2-square"></i> {{ Str::headline($item->name) }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
