@extends('layouts.blog')

@section('title')
    Home
@endsection

@section('content')
    <div class="container">
        <div class="row mt-5 d-flex align-items-stretch">
            <div class="col-md-8">
                <!-- Breadcrumb:Start -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('blog.home') }}" style="color: #005331">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Bayar Zakat</li>
                    </ol>
                </nav>
                <!-- Breadcrumb:end -->
                <h1 class="font-weight-bold">Zakat Online</h1>
                <p>Untuk melakukan Zakat Online, silahkan untuk langsung menentukan nominal dan metode pembayaran</p>
                <hr>
                <form action="{{ route('blog.store') }}" method="POST">
                    @csrf
                    {{-- Nomor HP --}}
                    <div class="form-group">
                        <label for="input_phone" class="font-weight-bold">
                            Nomor HP
                        </label>
                        <input id="input_phone" value="{{ old('phone') }}" name="phone" type="text"
                            class="form-control @error('phone') is-invalid @enderror" placeholder="contoh : 08525555555" />
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- Nama --}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="input_first_name" class="font-weight-bold">
                                    Nama Depan
                                </label>
                                <input id="input_first_name" value="{{ old('first_name') }}" name="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" placeholder="contoh : Muhammad" />
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="input_last_name" class="font-weight-bold">
                                    Nama Belakang
                                </label>
                                <input id="input_last_name" value="{{ old('last_name') }}" name="last_name" type="text"
                                    class="form-control  @error('last_name') is-invalid @enderror" placeholder="contoh : Hidayat" />
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- Email --}}
                    <div class="form-group">
                        <label for="input_email" class="font-weight-bold">
                            Email
                        </label>
                        <input id="input_email" value="{{ old('email') }}" name="email" type="text"
                            class="form-control @error('email') is-invalid @enderror" placeholder="contoh : contoh@gmail.com" />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- Domisili --}}
                    <div class="form-group">
                        <label for="input_location" class="font-weight-bold">
                            Domisili
                        </label>
                        <input id="input_location" value="{{ old('location') }}" name="location" type="text"
                            class="form-control @error('location') is-invalid @enderror" placeholder="contoh : Makassar" />
                        @error('location')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- nominal --}}
                    <div class="form-group">
                        <label for="input_donation" class="font-weight-bold">
                            Nominal yang ingin Anda titipkan
                        </label>
                        <input id="input_donation" value="{{ old('donation') }}" name="donation" type="text"
                            class="form-control @error('donation') is-invalid @enderror" placeholder="contoh : 10000" />
                        @error('donation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- kategori --}}
                    <div class="form-group">
                        <label for="input_donation_category" class="font-weight-bold">
                            Jenis titipan
                        </label>
                        <select class="custom-select my-1 mr-sm-2 @error('donation_category') is-invalid @enderror" id="inlineFormCustomSelectPref" name="donation_category">
                            <option selected disabled>Pilih jenis titipan</option>
                            <option value="zakat">Zakat</option>
                            <option value="infaq">Infaq</option>
                            <option value="sedekah">Sedekah</option>
                            <option value="wakaf">Wakaf</option>
                        </select>
                        @error('donation_category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- pesan --}}
                    <div class="form-group">
                        <label for="input_message" class="font-weight-bold">
                            Pesan/Keterangan
                        </label>
                        <textarea id="input_message" name="message" placeholder="berikan pesan disini..." class="form-control "
                            rows="5"></textarea>
                    </div>
                    {{-- Metode pembayaran --}}
                    <div class="form-group">
                        <label for="input_bank_payment" class="font-weight-bold">
                            Metode Pembayaran Transfer Bank
                        </label>
                        <select class="custom-select my-1 mr-sm-2 @error('bank_payment') is-invalid @enderror" id="inlineFormCustomSelectPref" name="bank_payment">
                            <option selected disabled>Pilih bank untuk transfer</option>
                            <option value="Bank_BNI">Bank BNI</option>
                            <option value="Bank_Muamalat">Bank Muamalat</option>
                            <option value="andiri_Syariah">Mandiri Syariah</option>
                            <option value="Bank_BRI">Bank BRI</option>
                            <option value="Bank_Sulselbar">Bank Sulselbar</option>
                        </select>
                        @error('bank_payment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success btn-lg btn-block">
                        Kirim
                    </button>
                </form>
                <hr>
                <h3>Transfer melalui mobile banking</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Bank</th>
                            <th scope="col">Nomor Rekening</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Bank BNI</td>
                            <td>364062644</td>
                        </tr>
                        <tr>
                            <td>Bank Muamalat</td>
                            <td>8060005673 </td>
                        </tr>
                        <tr>
                            <td>Mandiri Syariah</td>
                            <td>7306967999 </td>
                        </tr>
                        <tr>
                            <td>Bank BrI</td>
                            <td>022401000274 302 </td>
                        </tr>
                        <tr>
                            <td>Bank Sulselbar</td>
                            <td>0100030000065558</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                {{-- <img class="img-fluid" src="{{ asset('vendor/img/qris.jpeg') }}" alt=""> --}}
            </div>
        </div>
    </div>
@endsection
