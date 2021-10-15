@extends('layouts.dashboard')
@section('title')
    Tambah Roles
@endsection

@section('Breadcrumbs')
    {{ Breadcrumbs::render('add_role') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="input_role_name" class="font-weight-bold">
                                Nama Role
                            </label>
                            <input id="input_role_name" value="" name="name" type="text" class="form-control" readonly />
                        </div>
                        <!-- permission -->
                        <div class="form-group">
                            <label for="input_role_permission" class="font-weight-bold">
                                Permission
                            </label>
                            <div class="form-control overflow-auto h-100 " id="input_role_permission">
                                <div class="row">
                                    <!-- list manage name:start -->
                                    <ul class="list-group mx-1">
                                        <li class="list-group-item bg-dark text-white">
                                            Manage name
                                        </li>
                                        <!-- list permission:start -->
                                        <li class="list-group-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label">
                                                    Role name
                                                </label>
                                            </div>
                                        </li>
                                        <!-- list permission:end -->
                                    </ul>
                                    <!-- list manage name:end  -->
                                </div>
                            </div>
                        </div>
                        <div class="float-right mb-4">
                            <a class="btn btn-warning px-4 mx-2" href="">
                                Kembali
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
