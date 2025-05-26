@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-12 d-flex justify-content-between align-items-center mb-2">
            <h1 class="m-0">{{ __('Daftar Pembayaran') }}</h1>
            <div class="d-flex align-items-center">
                @if(in_array(auth()->user()->role, ['administrator', 'bendahara', 'administrasi']))
                <div class="mb-3 mr-2" style="width: 400px;">
                    <form action="{{ route('admin.payments.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="nama, email, paket travel,metode,status">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
                <a href="{{ route('admin.payments.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i>Pembayaran
                </a>
                @endif
            </div>
        </div>

        <style>
        @media (max-width: 768px) {
            .justify-content-between {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .align-items-center > *:first-child {
                margin-bottom: 1rem;
            }

            .mr-2 {
                margin-right: 0 !important;
                width: 100% !important;
                margin-bottom: 1rem !important;
            }
        }
        </style>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div style="overflow-x: auto;">
                            <table class="table table-striped" style="font-size: 10px;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Paket Travel</th>
                                        <th>Harga Paket</th>
                                        <th>Rincian</th>
                                        <th>Nominal</th>
                                        <th>Sisa Bayar</th>
                                        <th>Metode</th>
                                        <th>Tanggal Bayar</th> {{-- Kolom "Tanggal Bayar" dipindahkan ke sini --}}
                                        <th>Status</th>
                                        @if(in_array(auth()->user()->role, ['administrator', 'bendahara', 'administrasi']))
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($payments as $payment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $payment->booking->name ?? '-' }}</td>
                                        <td>{{ $payment->booking->email ?? '-' }}</td>
                                        <td>{{ $payment->booking->travel_package->type ?? '-' }}</td>
                                        <td>Rp. {{ number_format($payment->package_price ?? 0) }}</td>
                                        <td>{{ $payment->description ?? '-' }}</td>
                                        <td>Rp. {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($payment->remaining_payment_at_this ?? 0) }}</td>
                                        <td>{{ ucfirst($payment->method) }}</td>
                                        <td>{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') : '-' }}</td> {{-- Kolom "Tanggal Bayar" dipindahkan ke sini --}}
                                        <td>
                                            @if($payment->status === 'success')
                                            <span class="badge bg-success">success</span>
                                            @else
                                            <span class="badge bg-warning">{{ ucfirst($payment->status) }}</span>
                                            @endif
                                        </td>
                                        @if(in_array(auth()->user()->role, ['administrator', 'bendahara', 'administrasi']))
                                        <td>
                                            <a href="{{ route('admin.payments.edit', $payment->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form onclick="return confirm('Yakin ingin hapus pembayaran ini?');" class="d-inline-block" action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                        @endif
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="12" class="text-center">Belum ada pembayaran</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection