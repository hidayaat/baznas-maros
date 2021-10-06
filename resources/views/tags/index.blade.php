@extends('layouts.dashboard')

@section('title')
    Halaman Tag
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('tags') }}
@endsection

@section('content')
    <!-- section:content -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- Form : search --}}
                            <form action="{{ route('tags.index') }}" method="GET">
                                <div class="input-group">
                                    <input name="keyword" value="{{ request()->get('keyword') }}" type="search"
                                        class="form-control" placeholder="Cari tag">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('tags.create') }}" class="btn btn-primary float-right" role="button">
                                Add new
                                <i class="fas fa-plus-square"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @if (count($tags))
                            @foreach ($tags as $tag)
                                <li
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
                                    <label class="mt-auto mb-auto">
                                        {{ $tag->title }}
                                    </label>
                                    <div>
                                        <!-- edit -->
                                        <a href="{{ route('tags.edit', ['tag' => $tag]) }}" class="btn btn-sm btn-info"
                                            role="button">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- delete -->
                                        <form class="d-inline" role="alert"
                                            alert-text="Yakin ingin menghapus tag {{ old('title', $tag->title) }} ?"
                                            action="{{ route('tags.destroy', ['tag' => $tag]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <p>
                                <strong>
                                    @if (request()->get('keyword'))
                                        Tag {{ request()->get('keyword') }} tidak ditemukan
                                    @else
                                        Data tag belum ada
                                    @endif
                                </strong>
                            </p>
                        @endif
                    </ul>
                </div>
                @if ($tags->hasPages())
                <div class="card-footer">
                    {{ $tags->links('vendor.pagination.bootstrap-4') }}
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
                    title: "Hapus Tag",
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
