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
                                        <small class="form-text text-muted">
                                            File KTP saat ini:
                                            <a href="{{ Storage::url($booking->ktp) }}" target="_blank">Lihat</a>
                                            <button type="button" class="btn btn-sm btn-danger ml-2" onclick="deleteFile('{{ $booking->id }}', 'ktp')">Hapus</button>
                                        </small>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="paspor">Paspor</label>
                                    <input type="file" class="form-control" id="paspor" name="paspor">
                                    @if ($booking->paspor)
                                        <small class="form-text text-muted">
                                            File Paspor saat ini:
                                            <a href="{{ Storage::url($booking->paspor) }}" target="_blank">Lihat</a>
                                            <button type="button" class="btn btn-sm btn-danger ml-2" onclick="deleteFile('{{ $booking->id }}', 'paspor')">Hapus</button>
                                        </small>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="vaccine_document">Dokumen Vaksin</label>
                                    <input type="file" class="form-control" id="vaccine_document" name="vaccine_document" accept=".pdf,.jpg,.jpeg,.png">
                                    @if ($booking->vaccine_document)
                                        <small class="form-text text-muted">
                                            File saat ini:
                                            <a href="{{ Storage::url($booking->vaccine_document) }}" target="_blank">Lihat</a>
                                            <button type="button" class="btn btn-sm btn-danger ml-2" onclick="deleteFile('{{ $booking->id }}', 'vaccine_document')">Hapus</button>
                                        </small>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="shipment_receipt">Bukti Pengiriman Perlengkapan</label>
                                    <input type="file" class="form-control" id="shipment_receipt" name="shipment_receipt" accept=".pdf,.jpg,.jpeg,.png">
                                    @if ($booking->shipment_receipt)
                                        <small class="form-text text-muted">
                                            File bukti saat ini:
                                            <a href="{{ Storage::url($booking->shipment_receipt) }}" target="_blank">Lihat</a>
                                            <button type="button" class="btn btn-sm btn-danger ml-2" onclick="deleteFile('{{ $booking->id }}', 'shipment_receipt')">Hapus</button>
                                        </small>
                                    @endif
                                </div>

                                <script>
                                    function deleteFile(bookingId, columnName) {
                                        if (confirm('Apakah Anda yakin ingin menghapus file ini?')) {
                                            window.location.href = '/admin/bookings/' + bookingId + '/files/' + columnName;
                                        }
                                    }
                                </script>

                                <div class="form-group">
                                    <label for="shipment_info">Info Pengiriman/No Resi</label>
                                    <input type="text" class="form-control" id="shipment_info" name="shipment_info" value="{{ old('shipment_info', $booking->shipment_info ?? '') }}">
                                </div>
                                <div class="form-group">
                                    <label for="user_receipt_confirmation">Konfirmasi Penerima oleh Admin</label>
                                    <select class="form-control" id="user_receipt_confirmation" name="user_receipt_confirmation">
                                        <option value="0" {{ old('user_receipt_confirmation', $booking->user_receipt_confirmation) == 0 ? 'selected' : '' }}>Belum Dikonfirmasi</option>
                                        <option value="1" {{ old('user_receipt_confirmation', $booking->user_receipt_confirmation) == 1 ? 'selected' : '' }}>Sudah Dikonfirmasi</option>
                                    </select>
                                    <small class="form-text text-muted">Pilih status konfirmasi penerima oleh admin.</small>
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