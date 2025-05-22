@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1 class="m-0">{{ __('Form Edit') }}</h1>
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary"> <i class="fa fa-arrow-left"></i> </a>
                </div></div></div></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($blog->blogImages as $blogImage)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ asset('storage/' . $blogImage->image_path) }}" target="_blank">
                                                    <img width="100" src="{{ asset('storage/' . $blogImage->image_path) }}" alt="Gambar Blog">
                                                </a>
                                            </td>
                                            <td>
                                                <form onclick="return confirm('Apakah anda yakin ingin menghapus gambar ini?');" class="d-inline-block" action="{{ route('admin.blogs.images.destroy', [$blog, $blogImage]) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="3">Belum ada gambar galeri</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card p-3">
                        <form method="post" action="{{ route('admin.blogs.images.store', [$blog]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row border-bottom pb-4">
                                <label for="images" class="col-sm-2 col-form-label">Tambah Gambar Baru</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="images[]" id="images" multiple>
                                    <small class="form-text text-muted">Pilih beberapa gambar untuk ditambahkan ke galeri blog ini.</small>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan Gambar</button>
                        </form>
                    </div>

                    <div class="card p-3 mt-3">
                        <form method="post" action="{{ route('admin.blogs.update', [$blog]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group row border-bottom pb-4">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" value="{{ old('title', $blog->title) }}" id="title" placeholder="example: 5 tips travel">
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="category_id" class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="category_id" id="category_id">
                                        @foreach($categories as $category)
                                            <option {{ ($blog->category->id == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="image" class="col-sm-2 col-form-label">Featured Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" class="form-control" id="image">
                                    @if($blog->image)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $blog->image) }}" alt="Featured Image" width="100">
                                        </div>
                                    @endif
                                    <small class="form-text text-muted">Pilih gambar utama untuk blog ini (opsional).</small>
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="excerpt" class="col-sm-2 col-form-label">Excerpt</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="excerpt" id="excerpt" cols="30" rows="5">{{ old('excerpt', $blog->excerpt) }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="7">{{ old('description', $blog->description) }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Blog</button>
                        </form>
                    </div>
                </div>
            </div>
            </div></div>
    @endsection

@section('styles')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );

        // Script untuk menampilkan nama file yang dipilih pada input file
        document.addEventListener('DOMContentLoaded', function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection