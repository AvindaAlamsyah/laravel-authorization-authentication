@extends('internal.layouts.app')

@section('title', 'Role')

@section('breadcrumb')
    <li class="breadcrumb-item">Master</li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h5 class="card-title">List Roles</h5>
                    @can(PermissionsEnum::ROLE_CREATE->value)
                        <a class="btn btn-success btn-sm" href="{{ route('role.create') }}"><i class="bi bi-plus-square"></i> Create</a>
                    @endcan
                </div>
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Role</th>
                            <th class="text-end" width="180px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $index => $role)
                            <tr>
                                <td>{{ $roles->firstItem() + $index }}</td>
                                <td>{{ $role->name }}</td>
                                <td class="text-end" width="180px">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" type="button"
                                                aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            @can(PermissionsEnum::ROLE_VIEW->value)
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('role.show', $role->id) }}"><i class="bi bi-eye"></i>View</a>
                                                </li>
                                            @endcan
                                            @if (Auth::user()->can(PermissionsEnum::ROLE_EDIT->value) && $role->id != 1)
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('role.edit', $role->id) }}"><i
                                                           class="bi bi-pencil-square"></i>Edit</a>
                                                </li>
                                            @endif
                                            @if (Auth::user()->can(PermissionsEnum::ROLE_DELETE->value) && $role->id != 1)
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <button class="dropdown-item btn-delete" data-url="{{ route('role.destroy', $role->id) }}"
                                                            data-label="{{ $role->name }}" data-title="Role" type="button">
                                                        <i class="bi bi-trash"></i>Delete
                                                    </button>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No role data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $roles->links() }}
            </div>
        </div>
    </section>

    @include('internal.partials.modals.delete')
@endsection
