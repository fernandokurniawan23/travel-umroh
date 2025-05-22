@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12 justify-content-between d-flex">
                <h1 class="m-0">{{ __('Edit Pembayaran') }}</h1>
                <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                    <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="booking_id" value="{{ $payment->booking_id }}">

                        <div class="form-group">
                            <label>Nama Pemesan</label>
                            <input type="text" class="form-control" value="{{ $payment->booking->name ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Paket Travel</label>
                            <input type="text" class="form-control" value="{{ $payment->booking->travel_package->title ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Email Pemesan</label>
                            <input type="email" class="form-control" value="{{ $payment->booking->email ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Nominal</label>
                            <input type="number" name="amount" class="form-control" value="{{ old('amount', $payment->amount) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Metode Pembayaran</label>
                            <input type="text" name="method" class="form-control" value="{{ old('method', $payment->method) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Status Pembayaran</label>
                            <select name="status" class="form-control" required>
                                <option value="pending" {{ old('status', $payment->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="success" {{ old('status', $payment->status) === 'success' ? 'selected' : '' }}>Success</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Pembayaran</label>
                            <input type="date" name="payment_date" class="form-control" value="{{ old('payment_date', $payment->payment_date instanceof \Carbon\Carbon ? $payment->payment_date->format('Y-m-d') : $payment->payment_date) }}">
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="description" class="form-control" value="{{ old('description', $payment->description) }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Pembayaran</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection