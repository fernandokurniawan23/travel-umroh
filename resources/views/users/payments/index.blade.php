@extends('layouts.user')

@section('title', 'Histori Pembayaran Saya')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Histori Pembayaran</h2>

    @if($bookings->isEmpty())
        <div class="alert alert-info">
            Belum ada histori pembayaran.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Paket</th>
                        <th>Jumlah Pembayaran</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Tanggal Bayar</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->name }}</td>
                        <td>{{ $booking->travel_package->type ?? '-' }}</td>
                        <td>Rp {{ number_format($booking->amount_paid, 0, ',', '.') }}</td>
                        <td>{{ $booking->payment_method ?? '-' }}</td>
                        <td>
                            @if($booking->payment_status == 'paid')
                                <span class="badge bg-success">Lunas</span>
                            @elseif($booking->payment_status == 'pending')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($booking->payment_status) }}</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($booking->paid_at)->format('d M Y H:i') }}</td>
                        <td>{{ $booking->description ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
