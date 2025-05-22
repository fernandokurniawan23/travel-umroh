@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pembayaran</h1>

    <form action="{{ route('admin.payments.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="booking_id">Booking</label>
            <select name="booking_id" id="booking_id" class="form-control" required>
                <option value="">-- Pilih Booking --</option>
                @foreach($bookings as $booking)
                    <option value="{{ $booking->id }}">{{ $booking->name }} (ID: {{ $booking->id }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Nama Pemesan</label>
            <input type="text" class="form-control" id="customer_name" readonly>
        </div>

        <div class="form-group">
            <label>Email Pemesan</label>
            <input type="email" class="form-control" id="customer_email" readonly>
        </div>

        <div class="form-group">
            <label>Paket Wisata</label>
            <input type="text" class="form-control" id="travel_package_type" readonly>
        </div>

        <div class="form-group">
            <label>Harga Paket</label>
            <input type="text" class="form-control" id="travel_package_price" readonly>
        </div>

        <div class="form-group">
            <label>Sudah Dibayar</label>
            <input type="text" class="form-control" id="already_paid" readonly>
        </div>

        <div class="form-group">
            <label>Sisa Pembayaran</label>
            <input type="text" class="form-control" id="remaining_payment" readonly>
        </div>

        <div class="form-group">
            <label for="amount">Nominal Pembayaran Ini</label>
            <input type="number" name="amount" id="amount" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="method">Metode</label>
            <input type="text" name="method" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="success">Success</option>
                <option value="pending">Pending</option>
            </select>
        </div>

        <div class="form-group">
            <label for="payment_date">Tanggal Bayar</label>
            <input type="date" name="payment_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Keterangan</label>
            <input type="text" name="description" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bookingSelect = document.getElementById('booking_id');
        const customerNameInput = document.getElementById('customer_name');
        const customerEmailInput = document.getElementById('customer_email');
        const travelPackageTypeInput = document.getElementById('travel_package_type');
        const travelPackagePriceInput = document.getElementById('travel_package_price');
        const alreadyPaidInput = document.getElementById('already_paid');
        const remainingPaymentInput = document.getElementById('remaining_payment');
        const amountInput = document.getElementById('amount');

        bookingSelect.addEventListener('change', function() {
            const bookingId = this.value;
            if (bookingId) {
                fetch(`/admin/bookings/${bookingId}/details`)
                    .then(response => response.json())
                    .then(data => {
                        customerNameInput.value = data.name || '';
                        customerEmailInput.value = data.email || '';
                        travelPackageTypeInput.value = data.travel_package ? data.travel_package.type : '';
                        travelPackagePriceInput.value = data.travel_package ? formatCurrency(data.travel_package.price) : '';
                        fetch(`/admin/bookings/${bookingId}/payments`)
                            .then(response => response.json())
                            .then(payments => {
                                let totalPaid = payments.reduce((sum, payment) => sum + payment.amount, 0);
                                alreadyPaidInput.value = formatCurrency(totalPaid);
                                const price = data.travel_package ? data.travel_package.price : 0;
                                const remaining = price - totalPaid;
                                remainingPaymentInput.value = formatCurrency(remaining);
                            })
                            .catch(error => {
                                console.error('Error fetching payments:', error);
                                alreadyPaidInput.value = formatCurrency(0);
                                travelPackagePriceInput.value = data.travel_package ? formatCurrency(data.travel_package.price) : '';
                                remainingPaymentInput.value = data.travel_package ? formatCurrency(data.travel_package.price) : '';
                            });
                    })
                    .catch(error => {
                        console.error('Error fetching booking details:', error);
                        customerNameInput.value = '';
                        customerEmailInput.value = '';
                        travelPackageTypeInput.value = '';
                        travelPackagePriceInput.value = '';
                        alreadyPaidInput.value = '';
                        remainingPaymentInput.value = '';
                    });
            } else {
                customerNameInput.value = '';
                customerEmailInput.value = '';
                travelPackageTypeInput.value = '';
                travelPackagePriceInput.value = '';
                alreadyPaidInput.value = '';
                remainingPaymentInput.value = '';
            }
        });

        amountInput.addEventListener('input', function() {
            const paidSoFar = parseFloat(alreadyPaidInput.value.replace(/[^0-9.-]+/g,"")) || 0;
            const packagePrice = parseFloat(travelPackagePriceInput.value.replace(/[^0-9.-]+/g,"")) || 0;
            const currentPayment = parseFloat(this.value) || 0;
            const remaining = packagePrice - (paidSoFar + currentPayment);
            remainingPaymentInput.value = formatCurrency(remaining);
        });

        function formatCurrency(number) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
        }
    });
</script>
@endsection