@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Histori Pembayaran</h1>

    @if (count($paymentRincian) > 0)
        <form method="GET">
            <div class="mb-3">
                <label for="bookerSelect" class="form-label">Pilih Nama Pemesan:</label>
                <select class="form-select" id="bookerSelect" name="booker" onchange="this.form.submit()">
                    <option value="">Semua Pemesan</option>
                    @foreach ($bookerNames as $bookingId => $bookerName)
                        <option value="{{ $bookerName }}" {{ $selectedBooker == $bookerName ? 'selected' : '' }}>
                            {{ $bookerName }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        @foreach ($paymentRincian as $bookingId => $payments)
            @if (!$selectedBooker || $selectedBooker == $bookingDetails[$bookingId]['name'])
                <div class="card mb-4">
                    <div class="card-header">
                        <strong>Nama Pemesan:</strong> {{ $bookingDetails[$bookingId]['name'] }}<br>
                        <strong>Paket Travel:</strong> {{ $bookingDetails[$bookingId]['package'] }}<br>
                        <strong>Harga Paket:</strong> Rp. {{ number_format($bookingDetails[$bookingId]['price']) }}<br>
                        <strong>Sisa Pembayaran:</strong> Rp. {{ number_format(end($payments)['remaining']) }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive"> {{-- Tambahkan div ini --}}
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Rincian</th>
                                        <th>Nominal</th>
                                        <th>Sisa Pembayaran</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Metode</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $index => $payment)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $payment['rincian'] }}</td>
                                            <td>Rp. {{ number_format($payment['amount']) }}</td>
                                            <td>Rp. {{ number_format($payment['remaining']) }}</td>
                                            <td>{{ isset($payment['tanggal_bayar']) ? date('d-m-Y', strtotime($payment['tanggal_bayar'])) : '-' }}</td>
                                            <td>{{ $payment['metode'] ?? '-' }}</td>
                                            <td>
                                                @if($payment['status'] === 'success')
                                                    <span class="badge bg-success">Lunas</span>
                                                @elseif($payment['status'] === 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @else
                                                    <span class="badge bg-danger">{{ ucfirst($payment['status']) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> {{-- Tutup div table-responsive --}}
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <p>Tidak ada riwayat pembayaran.</p>
    @endif

    <h2 class="mt-4">Status Penerimaan Perlengkapan</h2>
    @if (count($bookingDetails) > 0)
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive"> {{-- Pastikan ini ada --}}
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Info Pengiriman/No. Resi</th>
                            <th>Bukti Penerimaan</th>
                            <th>Konfirmasi Penerimaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookingDetails as $bookingId => $details)
                            @if (!$selectedBooker || $selectedBooker == $details['name'])
                            <tr>
                                <td>{{ $details['shipment_info'] ?? '-' }}</td>
                                <td>
                                    @if($details['shipment_receipt'])
                                        <a href="{{ Storage::url($details['shipment_receipt']) }}" target="_blank" class="btn btn-sm btn-outline-primary w-100 mb-2">
                                            Lihat Bukti
                                        </a>
                                    @else
                                        <form method="POST" action="{{ route('user.booking.uploadReceipt', $bookingId) }}"
                                              enctype="multipart/form-data" class="mt-2">
                                            @csrf
                                            <div class="mb-2">
                                                <label for="shipment_receipt" class="form-label small d-block">MAX: 2MB</label>
                                                <input type="file"
                                                      class="form-control form-control-sm"
                                                      id="shipment_receipt"
                                                      name="shipment_receipt"
                                                      accept=".pdf,.jpg,.jpeg,.png"
                                                      style="font-size: 0.875rem;">
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-primary w-100">
                                                Unggah
                                            </button>
                                        </form>

                                        @if(session('upload_success_'.$bookingId))
                                            <div class="alert alert-success mt-2 small w-100">
                                                {{ session('upload_success_'.$bookingId) }}
                                            </div>
                                        @endif

                                        @error('shipment_receipt')
                                            <div class="alert alert-danger mt-2 small w-100">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @endif
                                </td>

                                <td>
                                    @if ($details['shipment_info'])
                                        @if (!$details['user_receipt_confirmation'])
                                            <form method="POST" action="{{ route('user.booking.markReceived', $bookingId) }}" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">Sudah Diterima</button>
                                            </form>
                                            <a href="https://wa.me/6285798807867?text=Halo,%20saya%20dengan%20data:%0ANama:%20{{ $details['name'] }}%0APaket:%20{{ $details['package'] }}%0AEmail:%20{{ $bookingDetails[$bookingId]['email'] ?? '' }}%0ANo.%20Telp:%20{{ $bookingDetails[$bookingId]['number_phone'] ?? '' }}%0Aingin%20menginformasikan%20bahwa%20saya%20belum%20menerima%20perlengkapan." class="btn btn-sm btn-warning ml-1" target="_blank">Belum Diterima</a>
                                        @elseif ($details['user_receipt_confirmation'])
                                            <span class="text-success">Dikonfirmasi Penerima</span>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <p class="mt-3">Tidak ada data booking.</p>
    @endif

    <a href="{{ route('homepage') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
</div>
@endsection