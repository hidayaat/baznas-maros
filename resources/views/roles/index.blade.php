@extends('layouts.dashboard')

@section('title')
    Roles
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('roles') }}
@endsection

@section('content')
    <!-- section:content -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('roles.index') }}" method="GET">
                                <div class="input-group">
                                    <input name="keyword" value="{{ request()->get('keyword') }}" type="search"
                                        class="form-control" placeholder="cari role...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            @can('role_create')
                                <a href="{{ route('roles.create') }}" class="btn btn-primary float-right" role="button">
                                    Tambah
                                    <i class="fas fa-plus-square"></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <!-- list role -->
                        @forelse ($roles as $role)
                            <li
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
                                <label class="mt-auto mb-auto">
                                    <!-- Role name -->
                                    {{ $role->name }}
                                </label>

                                <div>
                                    <!-- detail -->
                                    @can('role_detail')
                                        <a href="{{ route('roles.show', ['role' => $role]) }}" class="btn btn-sm btn-primary"
                                            role="button">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endcan
                                    <!-- edit -->
                                    @can('role_update')
                                        <a class="btn btn-sm btn-info" role="button"
                                            href="{{ route('roles.edit', ['role' => $role]) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan
                                    <!-- delete -->
                                    @can('role_delete')
                                        <form class="d-inline" role="alert"
                                            alert-text="Yakin ingin menghapus role {{ old('role', $role->name) }} ?"
                                            action="{{ route('roles.destroy', ['role' => $role]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </li>
                        @empty
                            <p>
                                <strong>
                                    @if (request()->get('keyword'))
                                        Roles {{ request()->get('keyword') }} tidak ditemukan
                                    @else
                                        Roles belum ada
                                    @endif
                                </strong>
                            </p>
                        @endforelse

                        <!-- list role -->
                    </ul>
                </div>
                @if ($roles->hasPages())
                    <div class="card-footer">
                        {{ $roles->links('vendor.pagination.bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@push('javascript-internal')
    <script>
        $(document).ready(function() {

            //event :delete tag
            $("form[role='alert']").submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: "Hapus Role",
                    text: $(this).attr('alert-text'),
                    icon: 'warning',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: "Batal",
                    reverseButtons: true,
                    confirmButtonText: "Hapus",
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.submit();
                    }
                });
            });
        });
    </script>

@endpush
