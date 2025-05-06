@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12 justify-content-between d-flex">
                <h1 class="m-0">{{ __('Booking') }}</h1>
                <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Tambah Booking
                </a>
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
                                        <th>Travel Package</th>
                                        <th>Payment Status</th>
                                        <th>Amount Paid</th>
                                        <th>Remaining Balance</th>
                                        <th>Payment Method</th>
                                        <th>Payment Type</th>
                                        <th>Transaction ID</th>
                                        <th>Paid At</th>
                                        <th>Action</th>
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
                                            -
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
                                        <td>{{ $booking->travel_package->type }}</td>
                                        <td>{{ $booking->payment_status ?? '-' }}</td>
                                        <td>{{ $booking->amount_paid ?? '-' }}</td>
                                        <td>{{ $booking->remaining_balance ?? '-' }}</td>
                                        <td>{{ $booking->payment_method ?? '-' }}</td>
                                        <td>{{ $booking->payment_type ?? '-' }}</td>
                                        <td>{{ $booking->transaction_id ?? '-' }}</td>
                                        <td>{{ $booking->paid_at ? \Carbon\Carbon::parse($booking->paid_at)->format('d M Y H:i') : '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form onclick="return confirm('are you sure ?');" class="d-inline-block" action="{{ route('admin.bookings.destroy', [$booking]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> </button>
                                            </form>
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