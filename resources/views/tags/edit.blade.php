@extends('layouts.dashboard')

@section('title')
    EditTag
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('edit_tag', $tag) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('tags.update', ['tag' => $tag]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- title -->
                        <div class="form-group">
                            <label for="input_tag_title" class="font-weight-bold">
                                Judul
                            </label>
                            <input id="input_tag_title" value=" {{ old('title', $tag->title) }}" name="title" type="text"
                                class="form-control @error('title') is-invalid @enderror" placeholder="Masukkan judul tag" />
                            @error('title')
                                <span class="invalid-feedback">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>
                        <!-- slug -->
                        <div class="form-group">
                            <label for="input_tag_slug" class="font-weight-bold">
                                Slug
                            </label>
                            <input id="input_tag_slug" value="{{ old('slug,', $tag->slug) }}" name="slug" type="text"
                                class="form-control @error('slug') is-invalid @enderror" placeholder="" readonly />
                            @error('slug')
                                <span class="invalid-feedback">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary px-4 mx-2" href="{{ route('tags.index') }}">Kembali</a>
                            <button type="submit" class="btn btn-success float-right px-4">
                                Ubah
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
            $("#input_tag_title").change(function(event) {
                $('#input_tag_slug').val(generateSlug(event.target.value))
            });
        });
    </script>
@endpush
