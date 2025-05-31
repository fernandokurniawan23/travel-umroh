<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class PublicProfileController extends Controller
{
    /**
     * Show the user's payment history with booking details and filtering by name.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function paymentHistory(Request $request)
    {
        $user = Auth::user();
        $payments = Payment::whereHas('booking', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('booking.travel_package')
          ->orderBy('booking_id')
          ->orderBy('payment_date')
          ->get();

        $groupedPayments = $payments->groupBy('booking_id');
        $bookingDetails = [];
        $paymentRincian = []; // Ganti nama variabel
        $bookerNames = [];

        foreach ($groupedPayments as $bookingId => $bookingPayments) {
            $firstPayment = $bookingPayments->first();
            // Pastikan booking lengkap di-load, termasuk receipt info dan user confirmation
            $booking = Booking::with('travel_package')->find($firstPayment->booking_id);
            if ($booking) {
                $bookingDetails[$bookingId] = [
                    'name' => $booking->name,
                    'package' => $booking->travel_package->type ?? '-',
                    'price' => $booking->travel_package->price ?? 0,
                    'shipment_info' => $booking->shipment_info ?? '-',
                    'shipment_receipt' => $booking->shipment_receipt,
                    'user_receipt_confirmation' => $booking->user_receipt_confirmation, // Tambahkan ini
                    'email' => $booking->email,
                    'number_phone' => $booking->number_phone,
                ];

                $totalPaid = 0;
                foreach ($bookingPayments as $payment) {
                    $totalPaid += $payment->amount;
                    $paymentRincian[$bookingId][] = [
                        'rincian' => $payment->description ?? '-',
                        'amount' => $payment->amount,
                        'remaining' => $booking->travel_package->price - $totalPaid,
                        'status' => $payment->status,
                        'tanggal_bayar' => $payment->payment_date,
                        'metode' => $payment->method,
                    ];
                }
                $bookerNames[$bookingId] = $booking->name;
            }
        }

        $selectedBooker = $request->input('booker');
        if ($selectedBooker && !in_array($selectedBooker, $bookerNames)) {
            $selectedBooker = null; // Reset jika nama tidak valid
        }

        return view('profile.payments', compact('paymentRincian', 'bookingDetails', 'bookerNames', 'selectedBooker')); // Ganti nama variabel
    }

    public function markReceiptReceived(Request $request, $bookingId)
    {
        $user = Auth::user();
        $booking = Booking::where('id', $bookingId)
                         ->where('user_id', $user->id)
                         ->firstOrFail();

        $booking->user_receipt_confirmation = true; // Set menjadi true
        $booking->save();

        return back()->with('success', 'Anda telah mengkonfirmasi penerimaan perlengkapan.');
    }
     public function uploadReceipt(Request $request, Booking $booking)
    {
        $validator = Validator::make($request->all(), [
            'shipment_receipt' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'shipment_receipt.required' => 'Bukti penerimaan harus diunggah.',
            'shipment_receipt.image' => 'File harus berupa gambar.',
            'shipment_receipt.mimes' => 'Format gambar yang didukung adalah jpeg, png, jpg.',
            'shipment_receipt.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['upload_error_' . $booking->id => $validator->errors()->first('shipment_receipt')]);
        }

        if ($request->hasFile('shipment_receipt')) {
            $file = $request->file('shipment_receipt');
            $filename = 'bukti_user_' . time() . '.' . $file->getClientOriginalExtension();
            // Simpan path relatif tanpa 'public/'
            $path = $file->store('uploads/bukti_pengiriman', 'public');

            // Setelah store, $path akan seperti 'uploads/bukti_pengiriman/nama_file.jpg'
            $booking->update(['shipment_receipt' => $path]);

            return back()->with(['upload_success_' . $booking->id => 'Bukti penerimaan berhasil diunggah.']);
        }

        return back()->withErrors(['upload_error_' . $booking->id => 'Gagal mengunggah bukti penerimaan.']);
    }

}