<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Booking;
use App\Mail\PaymentReceiptMail;

class PaymentController extends Controller
{
    public function success(Request $request)
    {
        // Kirim email konfirmasi (dengan asumsi user terakhir yang booking)
        $booking = Booking::with('travel_package') // penting agar relasi diload
            ->where('user_id', Auth::id())
            ->latest()
            ->first();

        if ($booking) {
            $booking->paid_at = now();
            $booking->amount_paid = 1000000;
            $booking->remaining_balance = $booking->travel_package->price - 1000000;
            $booking->save();

            // Mail::to($booking->email)->send(new \App\Mail\PaymentReceiptMail($booking));
        }

        return redirect('/')->with('success', 'Pembayaran DP berhasil! Bukti transaksi telah dikirim ke email Anda.');
    }
}
