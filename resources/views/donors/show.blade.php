@extends('layouts.dashboard')

@section('title')
    Profil donatur
@endsection

@section('content')
    <div class="row">
        <div class="col-6">
            <table class="table table-striped">
                <tr>
                    <th class="col-2">Nama</th>
                    <td class="col-4">{{ $donor->first_name }} {{ $donor->last_name }}</td>
                </tr>
                <tr>
                    <th>No. Telp.</th>
                    <td>{{ $donor->phone }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $donor->email }}</td>
                </tr>
                <tr>
                    <th>Nominal Donasi</th>
                    <td>Rp. {{ $donor->donation }}</td>
                </tr>
                <tr>
                    <th>Jenis Titipan</th>
                    <td>{{ $donor->donation_category }}</td>
                </tr>
                <tr>
                    <th>Pesan</th>
                    <td>{{ $donor->message }}</td>
                </tr>
                <tr>
                    <th>Jenis Bank</th>
                    <td>{{ $donor->bank_payment }}</td>
                </tr>
            </table>
            <div class="d-flex justify-content-end" style="margin-right: -10px">
                <a class=" btn btn-primary px-4 mx-2" href="{{ route('donors.index') }}">
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
