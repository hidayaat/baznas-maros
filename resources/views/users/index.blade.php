@extends('layouts.dashboard')

@section('title')
    Users
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('users') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="" method="GET">
                                <div class="input-group">
                                    <input name="keyword" value="" {{ request()->get('keyword') }} type="search"
                                        class="form-control" placeholder="Cari user...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            @can('user_create')
                                <a href="{{ route('users.create') }}" class="btn btn-primary float-right" role="button">
                                    Tambah
                                    <i class="fas fa-plus-square"></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- list users -->
                        @forelse ($users as $user)
                            <div class="col-md-4">
                                <div class="card my-1">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <i class="fas fa-id-badge fa-5x"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <table>
                                                    <tr>
                                                        <th>
                                                            Nama
                                                        </th>
                                                        <td>:</td>
                                                        <td>
                                                            {{-- show user name --}}
                                                            {{ $user->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Email
                                                        </th>
                                                        <td>:</td>
                                                        <td>
                                                            <!-- show user email -->
                                                            {{ $user->email }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Role
                                                        </th>
                                                        <td>:</td>
                                                        <td>
                                                            <!-- Show user roles -->
                                                            {{ $user->roles->first()->name }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="float-right">
                                            <!-- edit -->
                                            @can('user_update')
                                                <a href="{{ route('users.edit', ['user' => $user]) }}"
                                                    class="btn btn-sm btn-info" role="button">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan
                                            <!-- delete -->
                                            @can('user_delete')
                                                <form class="d-inline" role="alert"
                                                    alert-text="Yakin ingin menghapus user {{ old('name', $user->name) }} ?"
                                                    action="{{ route('users.destroy', ['user' => $user]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>
                                <strong>
                                    @if (request()->get('keyword'))
                                        User {{ request()->get('keyword') }} tidak ditemukan
                                    @else
                                        Belum ada data user
                                    @endif

                                </strong>
                            </p>
                        @endforelse
                    </div>
                </div>
                @if ($users->hasPages())
                    <div class="card-footer">
                        {{ $users->links('vendor.pagination.bootstrap-4') }}
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

@push('javascript-internal')
    <script>
        $(document).ready(function() {

            //event :delete user
            $("form[role='alert']").submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: "Hapus User",
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
