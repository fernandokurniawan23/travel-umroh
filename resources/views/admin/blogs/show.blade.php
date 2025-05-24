@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Blog</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $blog->title }}</h5>
                <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="img-fluid mb-3">
                <p class="card-text">{{ $blog->content }}</p>
                <p class="card-text"><strong>Kategori:</strong> {{ $blog->category->name }}</p>
                <p class="card-text"><strong>Tanggal Dibuat:</strong> {{ $blog->created_at }}</p>

                <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary">Kembali ke Daftar Blog</a>
            </div>
        </div>
    </div>
@endsection