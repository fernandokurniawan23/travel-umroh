<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class PublicProfileController extends Controller
{
    /**
     * Show the user's profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        return view('profile.show'); // Asumsi nama view profil adalah show
    }

    /**
     * Show the user's payment history with booking details and remaining payment after each transaction.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function paymentHistory()
    {
        $user = Auth::user();
        $payments = Payment::whereHas('booking', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('booking.travel_package') // Eager load relasi
          ->orderBy('booking_id') // Urutkan berdasarkan booking
          ->orderBy('payment_date') // Urutkan berdasarkan tanggal pembayaran
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

        return view('profile.payments', compact('payments'));
    }
}