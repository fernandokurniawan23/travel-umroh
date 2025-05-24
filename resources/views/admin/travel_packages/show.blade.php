@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Paket Wisata</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $travel_package->type }}</h5>
                <p class="card-text">Lokasi: {{ $travel_package->location }}</p>
                <p class="card-text">Keberangkatan: {{ $travel_package->departure_date }}</p>
                <p class="card-text">Durasi: {{ $travel_package->duration }}</p>
                <p class="card-text">Harga: {{ $travel_package->price }}</p>
                <a href="{{ route('admin.travel_packages.index') }}" class="btn btn-primary">Kembali ke Daftar</a>
            </div>
        </div>
    </div>
@endsection