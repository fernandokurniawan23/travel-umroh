@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1 class="m-0">{{ __('Form Create') }}</h1>
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary"> <i class="fa fa-arrow-left"></i> </a>
                </div></div></div></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-3">
                        <form method="post" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row border-bottom pb-4">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" id="title" placeholder="example: 5 tips travel">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="category_id" class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="category_id" id="category_id">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $category)
                                            <option {{ (old('category_id') == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="image" class="col-sm-2 col-form-label">Featured Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" class="form-control" id="image">
                                    <small class="form-text text-muted">Pilih gambar utama untuk blog ini (opsional).</small>
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="images" class="col-sm-2 col-form-label">Gambar Galeri</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="images[]" id="images" multiple>
                                    <small class="form-text text-muted">Pilih beberapa gambar untuk ditambahkan ke galeri blog ini (opsional).</small>
                                    @error('images')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @error('images.*')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="excerpt" class="col-sm-2 col-form-label">Excerpt</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="excerpt" id="excerpt" cols="30" rows="5">{{ old('excerpt') }}</textarea>
                                    @error('excerpt')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="7">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Save Blog</button>
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
    </script>
@endsection