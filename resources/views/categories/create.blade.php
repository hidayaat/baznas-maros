@extends('layouts.dashboard')

@section('title')
    Tambah Kategori
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('add_category') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST">
                        <!-- title -->
                        <div class="form-group">
                            <label for="input_category_title" class="font-weight-bold">
                                Judul
                            </label>
                            <input id="input_category_title" value="" name="title" type="text" class="form-control"
                                placeholder="Masukkan Judul" />
                        </div>
                        <!-- slug -->
                        <div class="form-group">
                            <label for="input_category_slug" class="font-weight-bold">
                                Slug
                            </label>
                            <input id="input_category_slug" value="" name="slug" type="text" class="form-control"
                                readonly />
                        </div>
                        <!-- thumbnail -->
                        <div class="form-group">
                            <label for="input_category_thumbnail" class="font-weight-bold">
                                Thumbnail
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button id="button_category_thumbnail" data-input="input_category_thumbnail"
                                        class="btn btn-primary" type="button">
                                        Telusuri
                                    </button>
                                </div>
                                <input id="input_category_thumbnail" name="thumbnail" value="" type="text"
                                    class="form-control" placeholder="Masukkan file" readonly />
                            </div>
                        </div>
                        <!-- parent_category -->
                        <div class="form-group">
                            <label for="select_category_parent" class="font-weight-bold">Induk Kategori</label>
                            <select id="select_category_parent" name="parent_category" data-placeholder=""
                                class="custom-select w-100">
                            </select>
                        </div>
                        <!-- description -->
                        <div class="form-group">
                            <label for="input_category_description" class="font-weight-bold">
                                Deskripsi
                            </label>
                            <textarea id="input_category_description" name="description" class="form-control" rows="3"
                                placeholder="Masukkan deskripsi disini..."></textarea>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary px-4" href="{{ route('categories.index') }}">Kembali</a>
                            <button type="submit" class="btn btn-success px-4">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('css-external')
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}">
@endpush

@push('javascript-external')
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/i18n/id.js') }}"></script>
@endpush

@push('javascript-internal')
    <script>
        $(function() {
            //generate slug
            function generateSlug(value) {
                return value.trim()
                    .toLowerCase()
                    .replace(/[^a-z\d-]/gi, '-')
                    .replace(/-+/g, '-').replace(/^-|-$/g, "");
            }

            //select2 parent category
            $('#select_category_parent').select2({
                theme: 'bootstrap4',
                language: "",
                allowClear: true,
                ajax: {
                    url: "{{ route('categories.select') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.title,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });

            // event:input title
            $('#input_category_title').change(function() {
               let title = $(this).val();
               let parent_category = $('#select_category_parent').val() ?? "";
               $('#input_category_slug').val(generateSlug(parent_category + " " + title));
            });

            // event:select paarent category
            $('#select_category_parent').change(function() {
               let title = $('#input_category_title').val();
               let parent_category = $(this).val() ?? "";
               $('#input_category_slug').val(generateSlug(parent_category + " " + title));
            });
        });
    </script>

@endpush
