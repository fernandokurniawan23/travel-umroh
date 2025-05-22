<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('booking.travel_package')
            ->orderBy('booking_id')
            ->orderBy('payment_date')
            ->paginate(10);

        $bookingTotalsPaid = [];

        foreach ($payments as $payment) {
            $bookingId = $payment->booking_id;
            $packagePrice = $payment->booking->travel_package->price ?? 0;

            if (!isset($bookingTotalsPaid[$bookingId])) {
                $bookingTotalsPaid[$bookingId] = 0;
            }
            $bookingTotalsPaid[$bookingId] += $payment->amount;
            $payment->package_price = $packagePrice;
            $payment->remaining_payment_at_this = $packagePrice - $bookingTotalsPaid[$bookingId];
        }

        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $bookings = Booking::all();
        return view('admin.payments.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'payment_date' => 'nullable|date',
            'description' => 'nullable|string|max:500',
        ]);

        Payment::create($request->all());

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function show(Payment $payment)
    {
        return view('admin.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $bookings = Booking::all();
        return view('admin.payments.edit', compact('payment', 'bookings'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'payment_date' => 'nullable|date',
            'description' => 'nullable|string|max:500',
        ]);

        $payment->update($request->all());

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function getBookingDetails(Booking $booking)
    {
        $booking->load('travel_package');
        return response()->json([
            'id' => $booking->id,
            'name' => $booking->name,
            'email' => $booking->email,
            'travel_package' => $booking->travel_package ? ['type' => $booking->travel_package->type, 'price' => $booking->travel_package->price] : null,
        ]);
    }

    public function getBookingPayments(Booking $booking)
    {
        $payments = Payment::where('booking_id', $booking->id)->get();
        return response()->json($payments);
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}