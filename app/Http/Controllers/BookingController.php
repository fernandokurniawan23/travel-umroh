<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\MidtransService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log; // Tambahkan import Log

class BookingController extends Controller
{
    // protected $midtrans;

    // public function __construct(MidtransService $midtrans)
    // {
    //     $this->midtrans = $midtrans;
    // }

    public function store(BookingRequest $request)
    {
        // Validasi reCAPTCHA
        $request->validate([
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'g-recaptcha-response.required' => 'Captcha harus diisi.',
            'g-recaptcha-response.captcha' => 'Captcha tidak valid.',
        ]);
        
        // Simpan file KTP ke dalam storage
        $ktpPath = $request->hasFile('ktp')
            ? $request->file('ktp')->store('ktp_uploads', 'public')
            : null;

        // Simpan file Paspor jika diunggah (opsional)
        $pasporPath = $request->hasFile('paspor')
            ? $request->file('paspor')->store('paspor_uploads', 'public')
            : null;

        // Buat data booking (tanpa order_id terlebih dahulu)
        $booking = new Booking([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'number_phone' => $request->number_phone,
            'travel_package_id' => $request->travel_package_id,
            'ktp' => $ktpPath, // Simpan path file KTP
            'paspor' => $pasporPath, // Simpan path file Paspor (jika ada)
            // 'order_id' => 'ORDER-' . Str::upper(Str::random(10)), // Hapus pembuatan order_id di sini
        ]);

        $booking->save(); // Simpan booking untuk mendapatkan ID
        // Generate order_id untuk user
        $orderId = 'USR-' . $booking->id . '-' . now()->format('YmdHi');
        $booking->update(['order_id' => $orderId]);

        // Buat Snap URL Midtrans dan dapatkan order_id dari service
        // $midtransResult = $this->midtrans->createTransaction($booking);
        // $snapUrl = $midtransResult['snap_url'];
        // $orderId = $midtransResult['order_id'];

        // // Update model booking dengan order_id dari Midtrans
        // $booking->order_id = $orderId;
        // $booking->save();

        // Log::info('Order ID yang Dibuat dan Disimpan:', ['order_id' => $booking->order_id, 'booking_id' => $booking->id]);

        // return redirect($snapUrl);

        $waNumber = '6285798807867'; // Ganti dengan nomor WA bisnis kamu
        $package = $booking->travel_package->type ?? 'Paket Umrah'; // asumsi relasi ada

        $waMessage = urlencode("Halo Admin, saya ingin booking paket umrah:\n\nOrder ID: {$booking->order_id}\nNama: {$booking->name}\nNo HP: {$booking->number_phone}\nEmail: {$booking->email}\nPaket: {$package}");

        return redirect()->away("https://wa.me/{$waNumber}?text={$waMessage}");
    }
}
