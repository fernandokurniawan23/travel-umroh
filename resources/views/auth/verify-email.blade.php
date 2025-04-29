@extends('layouts.user')

@section('title', 'Verifikasi Email')

@section('content')
<div class="container" style="max-width: 600px; margin: auto; padding: 50px 20px; text-align: center;">
    @if (session('message'))
    <div class="alert alert-success" style="margin-bottom: 20px;">
        {{ session('message') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger" style="margin-bottom: 20px;">
        {{ session('error') }}
    </div>
    @endif

    <img src="{{ asset('images/logo.png') }}" alt="Haromain Travel" style="max-width: 150px; margin-bottom: 20px;"> <!-- opsional kalau punya logo -->

    <h1 style="font-weight: bold; color: #2E3A59;">Verifikasi Email Anda</h1>

    <p style="margin-top: 20px; font-size: 16px; color: #555;">
        Terima kasih telah mendaftar di <strong>Haromain Travel</strong>! <br>
        Kami telah mengirimkan link verifikasi ke email Anda. <br>
        Silakan cek inbox atau folder spam untuk menyelesaikan proses registrasi.
    </p>

    <p style="margin-top: 10px; font-size: 15px; color: #777;">
        Setelah verifikasi, Anda dapat melanjutkan proses booking perjalanan umrah dan haji bersama kami.
    </p>

    <form method="POST" action="{{ route('verification.send') }}" style="margin-top: 30px;">
        @csrf
        <button type="submit" class="btn btn-primary">
            Kirim Ulang Email Verifikasi
        </button>
    </form>

    <p style="margin-top: 20px; font-size: 14px; color: #999;">
        Belum menerima email? Coba cek folder spam, atau klik tombol di atas untuk mengirim ulang.
    </p>

</div>
@endsection