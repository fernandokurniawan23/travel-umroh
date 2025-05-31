@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12 d-flex justify-content-between">
                <h1 class="m-0">{{ __('Tambah Booking') }}</h1>
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
                    <form method="post" action="{{ route('admin.bookings.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="travel_package_id">Paket Travel</label>
                                    <select class="form-control" id="travel_package_id" name="travel_package_id" required>
                                        <option value="">Pilih Paket Travel</option>
                                        @foreach ($travelPackages as $package)
                                        <option value="{{ $package->id }}">{{ $package->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="number_phone">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="number_phone" name="number_phone" value="{{ old('number_phone') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="ktp">KTP MAX: 2MB</label>
                                    <input type="file" class="form-control" id="ktp" name="ktp">
                                </div>
                                <div class="form-group">
                                    <label for="paspor">Paspor MAX: 2MB</label>
                                    <input type="file" class="form-control" id="paspor" name="paspor">
                                </div>
                                <div class="form-group">
                                    <label for="vaccine_document">Dokumen Vaksin MAX: 2MB</label>
                                    <input type="file" class="form-control" id="vaccine_document" name="vaccine_document">
                                </div>
                                <div class="form-group">
                                    <label for="shipment_receipt">Bukti Penerimaan Perlengkapan MAX: 2MB</label>
                                    <input type="file" class="form-control" id="shipment_receipt" name="shipment_receipt" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                                <div class="form-group">
                                    <label for="shipment_info">Info Pengiriman/No Resi</label>
                                    <input type="text" class="form-control" id="shipment_info" name="shipment_info" value="{{ old('shipment_info') ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label>Konfirmasi User</label>
                                    <div>
                                        <span class="text-muted">Status konfirmasi user akan muncul setelah booking dibuat.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection