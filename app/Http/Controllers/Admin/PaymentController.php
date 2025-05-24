<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator; // Tambahkan ini

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $payments = Payment::with('booking.travel_package')
            ->orderBy('payment_date', 'desc');

        if ($search) {
            $payments->where(function ($query) use ($search) {
                $query->whereHas('booking', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhereHas('travel_package', function ($q2) use ($search) {
                            $q2->where('type', 'like', '%' . $search . '%');
                        });
                })
                ->orWhere('method', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $payments = $payments->paginate(10);

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
        $bookings = Booking::all(); // Atau Booking::with('travel_package')->get() jika perlu
        return view('admin.payments.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|string|max:255',
            'status' => 'required|string|max:255|in:pending,success', // Tambahkan in:pending,success
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
        // Eager load booking dan travel_package
        $payment = Payment::with('booking.travel_package')->findOrFail($payment->id);
        $bookings = Booking::all(); // Atau Booking::with('travel_package')->get() jika perlu
        return view('admin.payments.edit', compact('payment', 'bookings'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validator = Validator::make($request->all(), [ // Gunakan Validator
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|string|max:255',
            'status' => ['required', 'string', 'max:255', 'in:pending,success'], // Gunakan array untuk rules
            'payment_date' => 'nullable|date',
            'description' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Eager load (meskipun mungkin tidak langsung diperlukan di sini)
        $payment = Payment::with('booking.travel_package')->findOrFail($payment->id);
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