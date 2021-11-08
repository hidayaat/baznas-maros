@extends('layouts.dashboard')

@section('title')
    Halaman Donatur
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('donors') }}
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
                                    <input name="keyword" value="" type="search" class="form-control" placeholder="">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row table-responsive">
                        <!-- list donatur -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Jenis Titipan</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($donors as $donor)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $donor->first_name }} {{ $donor->last_name }}</td>
                                        <td>{{ $donor->email }}</td>
                                        <td>{{ $donor->donation_category }}</td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-sm btn-primary" role="button">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-info" role="button">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="" method="POST" role="alert" class="d-inline">
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
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
                            </tbody>
                        </table>
                        {{-- list donatur --}}
                    </div>
                </div>
                @if ($donors->hasPages())
                    <div class="card-footer">
                        {{ $donors->links('vendor.pagination.bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
