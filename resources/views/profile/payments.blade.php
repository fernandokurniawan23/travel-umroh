@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Histori Pembayaran</h1>

    @if ($payments->isEmpty())
        <p>Tidak ada riwayat pembayaran.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal Bayar</th>
                    <th>Nama Pemesan</th>
                    <th>Paket Travel</th>
                    <th>Harga Paket</th>
                    <th>Nominal</th>
                    <th>Metode</th>
                    <th>Status</th>
                    <th>Sisa Pembayaran</th> {{-- Sisa setelah pembayaran ini --}}
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') : '-' }}</td>
                    <td>{{ $payment->booking->name ?? '-' }}</td>
                    <td>{{ $payment->booking->travel_package->type ?? '-' }}</td>
                    <td>Rp. {{ number_format($payment->booking->travel_package->price ?? 0) }}</td>
                    <td>Rp. {{ number_format($payment->amount) }}</td>
                    <td>{{ ucfirst($payment->method) }}</td>
                    <td>
                        @if($payment->status === 'success')
                            <span class="badge bg-success">Lunas</span>
                        @else
                            <span class="badge bg-warning">{{ ucfirst($payment->status) }}</span>
                        @endif
                    </td>
                    <td>Rp. {{ number_format($payment->remaining_payment_at_this ?? 0) }}</td>
                    <td>{{ $payment->description ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $payments->links() }}
    @endif

    <div class="mt-3">
        <a href="{{ route('homepage') }}" class="btn btn-info">Kembali ke Home</a>
    </div>
</div>
@endsection