@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12 d-flex justify-content-between">
                <h1 class="m-0">{{ __('Edit Booking') }}</h1>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-primary"> <i class="fa fa-arrow-left"></i> Kembali </a>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-3">
                    <form method="post" action="{{ route('admin.bookings.update', [$booking]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="travel_package_id">Paket Travel</label>
                                    <select class="form-control" id="travel_package_id" name="travel_package_id" required>
                                        <option value="">Pilih Paket Travel</option>
                                        @foreach ($travelPackages as $package)
                                        <option value="{{ $package->id }}" {{ old('travel_package_id', $booking->travel_package_id) == $package->id ? 'selected' : '' }}>
                                            {{ $package->type }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $booking->name) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $booking->email) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="number_phone">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="number_phone" name="number_phone" value="{{ old('number_phone', $booking->number_phone) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="ktp">KTP</label>
                                    <input type="file" class="form-control" id="ktp" name="ktp">
                                    @if ($booking->ktp)
                                    <small class="form-text text-muted">File KTP saat ini: <a href="{{ Storage::url($booking->ktp) }}" target="_blank">Lihat</a></small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="paspor">Paspor (opsional)</label>
                                    <input type="file" class="form-control" id="paspor" name="paspor">
                                    @if ($booking->paspor)
                                    <small class="form-text text-muted">File Paspor saat ini: <a href="{{ Storage::url($booking->paspor) }}" target="_blank">Lihat</a></small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_status">Status Pembayaran</label>
                                    <input type="text" class="form-control" id="payment_status" name="payment_status" value="{{ old('payment_status', $booking->payment_status) }}">
                                </div>
                                <div class="form-group">
                                    <label for="amount_paid">Jumlah Dibayar</label>
                                    <input type="number" class="form-control" id="amount_paid" name="amount_paid" value="{{ old('amount_paid', $booking->amount_paid) }}">
                                </div>
                                <div class="form-group">
                                    <label for="remaining_balance">Sisa Pembayaran</label>
                                    <input type="number" class="form-control" id="remaining_balance" name="remaining_balance" value="{{ old('remaining_balance', $booking->remaining_balance) }}">
                                </div>
                                <div class="form-group">
                                    <label for="payment_method">Metode Pembayaran</label>
                                    <input type="text" class="form-control" id="payment_method" name="payment_method" value="{{ old('payment_method', $booking->payment_method) }}">
                                </div>
                                <div class="form-group">
                                    <label for="payment_type">Tipe Pembayaran</label>
                                    <input type="text" class="form-control" id="payment_type" name="payment_type" value="{{ old('payment_type', $booking->payment_type) }}">
                                </div>
                                <div class="form-group">
                                    <label for="transaction_id">ID Transaksi</label>
                                    <input type="text" class="form-control" id="transaction_id" name="transaction_id" value="{{ old('transaction_id', $booking->transaction_id) }}">
                                </div>
                                <div class="form-group">
                                    <label for="paid_at">Tanggal Pembayaran</label>
                                    <input type="date" class="form-control" id="paid_at" name="paid_at" value="{{ old('paid_at', $booking->paid_at ? \Carbon\Carbon::parse($booking->paid_at)->format('Y-m-d') : '') }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection