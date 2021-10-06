@extends('layouts.dashboard')

@section('title')
    Buat Tag
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('add_tag') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST">
                        <!-- title -->
                        <div class="form-group">
                            <label for="input_tag_title" class="font-weight-bold">
                                Judul
                            </label>
                            <input id="input_tag_title" value="" name="title" type="text" class="form-control"
                                placeholder="Masukkan judul tag" />
                        </div>
                        <!-- slug -->
                        <div class="form-group">
                            <label for="input_tag_slug" class="font-weight-bold">
                                Slug
                            </label>
                            <input id="input_tag_slug" value="" name="slug" type="text" class="form-control" placeholder=""
                                readonly />
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary px-4 mx-2" href="{{ route('tags.index') }}">Kembali</a>
                            <button type="submit" class="btn btn-success float-right px-4">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('javascript-internal')
    <script>
        $(document).ready(function() {
            const generateSlug = (value) => {
                return value.trim()
                    .toLowerCase()
                    .replace(/[^a-z\d-]/gi, '-')
                    .replace(/-+/g, '-').replace(/^-|-$/g, "")
            }
            //event :slug
            $("#input_tag_title").change(function (event) {
                $('#input_tag_slug').val(generateSlug(event.target.value))
            });
        });
    </script>
@endpush
