@extends('internal.layouts.app')

@section('title', 'User')

@section('breadcrumb')
    <li class="breadcrumb-item">Master</li>
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h5 class="card-title">List Users</h5>
                    @can(PermissionsEnum::USER_CREATE->value)
                        <a class="btn btn-success btn-sm" href="{{ route('user.create') }}"><i class="bi bi-plus-square"></i> Create</a>
                    @endcan
                </div>

                <div class="table-responsive-md mb-3">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="text-end" width="180px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $index => $user)
                                <tr>
                                    <td>{{ $users->firstItem() + $index }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                    <td class="text-end" width="180px">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" type="button"
                                                    aria-expanded="false">
                                                Action
                                            </button>
                                            <ul class="dropdown-menu">
                                                @can(PermissionsEnum::USER_VIEW->value)
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('user.show', $user->id) }}"><i class="bi bi-eye"></i>View</a>
                                                    </li>
                                                @endcan
                                                @if (Auth::user()->can(PermissionsEnum::USER_EDIT->value) && ($user->id != 1 || Auth::user()->id == 1))
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('user.edit', $user->id) }}"><i
                                                               class="bi bi-pencil-square"></i>Edit</a>
                                                    </li>
                                                @endif
                                                @if (Auth::user()->can(PermissionsEnum::USER_DELETE->value) && $user->id != 1)
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item btn-delete" data-url="{{ route('user.destroy', $user->id) }}"
                                                                data-label="{{ $user->name }}" data-title="User" type="button">
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
                                    <td colspan="5">No user data available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $users->links() }}
            </div>
        </div>
    </section>

    @can(PermissionsEnum::USER_DELETE->value)
        @include('internal.partials.modals.delete')
    @endcan
@endsection
