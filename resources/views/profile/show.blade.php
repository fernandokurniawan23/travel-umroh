@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Profil Saya</h1>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <p>Selamat datang, {{ Auth::user()->name }}!</p>
    <p>Email Anda: {{ Auth::user()->email }}</p>

    <div>
        <a href="{{ route('user.profile.payments') }}" class="btn btn-primary">Lihat Histori Pembayaran</a>
    </div>
</div>
@endsection