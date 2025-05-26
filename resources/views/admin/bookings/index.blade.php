@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12 justify-content-between d-flex">
                <h1 class="m-0">{{ __('Booking') }}</h1>
                @if(in_array(auth()->user()->role, ['administrator', 'administrasi']))
                <div class="mb-3">
                    <form action="{{ route('admin.bookings.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="nama, email, paket travel">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Tambah Booking
                </a>
                @endif
            </div>
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number Phone</th>
                                        <th>KTP</th>
                                        <th>Paspor</th>
                                        <th>Vaksin</th>
                                        <th>Travel Package</th>
                                        <th>Info Pengiriman</th>
                                        <th>Bukti Pengiriman</th>
                                        <th>Konfirmasi User</th>
                                        @if(in_array(auth()->user()->role, ['administrator', 'administrasi']))
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $booking->name }}</td>
                                        <td>{{ $booking->email }}</td>
                                        <td>{{ $booking->number_phone }}</td>
                                        <td>
                                            @if($booking->ktp)
                                            <a href="{{ Storage::url($booking->ktp) }}" target="_blank">
                                                <img src="{{ Storage::url($booking->ktp) }}" alt="KTP" width="50">
                                            </a>
                                            @else
                                            <span class="text-muted">No ktp</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($booking->paspor)
                                            <a href="{{ Storage::url($booking->paspor) }}" target="_blank">
                                                <img src="{{ Storage::url($booking->paspor) }}" alt="Paspor" width="50">
                                            </a>
                                            @else
                                            <span class="text-muted">No Passport</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($booking->vaccine_document)
                                            <a href="{{ Storage::url($booking->vaccine_document) }}" target="_blank">
                                                <i class="fa fa-file"></i> Lihat
                                            </a>
                                            @else
                                            <span class="text-muted"> No Vaccine</span>
                                            @endif
                                        </td>
                                        <td>{{ $booking->travel_package->type }}</td>
                                        <td>{{ $booking->shipment_info ?? '-' }}</td> <td>
                                            @if($booking->shipment_receipt)
                                            <a href="{{ Storage::url($booking->shipment_receipt) }}" target="_blank">
                                                <i class="fa fa-file"></i> Lihat Bukti
                                            </a>
                                            @else
                                            <span class="text-muted">Belum ada</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($booking->user_receipt_confirmation)
                                                <span class="text-success">Sudah</span>
                                            @else
                                                <span class="text-danger">Belum</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(in_array(auth()->user()->role, ['administrator', 'administrasi']))
                                            <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @endif

                                            @if(in_array(auth()->user()->role, ['administrator', 'administrasi']))
                                            <form onclick="return confirm('are you sure ?');" class="d-inline-block" action="{{ route('admin.bookings.destroy', [$booking]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> </button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection