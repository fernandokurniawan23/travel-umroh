@extends('layouts.app')

@section('content')
@php
    $canCreateOrEdit = in_array(auth()->user()->role, ['administrator', 'administrasi']);
    $canDelete = auth()->user()->role === 'administrator';
@endphp

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12 justify-content-between d-flex">
                <h1 class="m-0">{{ __('Blog') }}</h1>
                @if($canCreateOrEdit)
                    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
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
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Excerpt</th>
                                    <th>Category</th>
                                    @if($canCreateOrEdit)
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($blogs as $blog)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $blog->title }}</td>
                                    <td>
                                        <a href="{{ Storage::url($blog->image) }}" target="_blank">
                                            <img src="{{ Storage::url($blog->image) }}" width="100" alt="">
                                        </a>
                                    </td>
                                    <td>{{ $blog->excerpt }}</td>
                                    <td>{{ $blog->category->name }}</td>
                                    @if($canCreateOrEdit)
                                        <td>
                                            <a href="{{ route('admin.blogs.edit', [$blog]) }}" class="btn btn-sm btn-info">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            @if($canDelete)
                                                <form onclick="return confirm('Are you sure?');" class="d-inline-block" action="{{ route('admin.blogs.destroy', [$blog]) }}" method="post">
                                                    @csrf 
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer clearfix">
                        {{ $blogs->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /.content -->
@endsection
