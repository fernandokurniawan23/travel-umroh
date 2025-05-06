<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        Log::info('>> MIDTRANS CALLBACK MASUK', $request->all());
        Log::info('📩 Callback masuk dari Midtrans');
        Log::debug('📦 Isi Request:', $request->all());

        $serverKey = config('midtrans.server_key');
        $signatureKey = $request->signature_key;
        $orderId = $request->order_id;
        $statusCode = $request->status_code;
        $grossAmount = $request->gross_amount;

        // Validasi signature
        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        // Temukan booking berdasarkan order_id
        Log::debug('Mencari Booking dengan Order ID:', ['order_id' => $orderId]);
        $booking = Booking::where('order_id', $orderId)->first();

        if ($signatureKey !== $expectedSignature) {
            Log::warning('>> Invalid Midtrans signature', [
                'expected' => $expectedSignature,
                'received' => $signatureKey
            ]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Temukan booking berdasarkan order_id
        $booking = Booking::where('order_id', $orderId)->first();

        if (!$booking) {
            Log::warning('>> Booking tidak ditemukan', ['order_id' => $orderId]);
            return response()->json(['message' => 'Booking not found'], 404);
        }

        // Update data pembayaran
        $booking->payment_status = $request->transaction_status;
        $booking->payment_type = $request->payment_type ?? null;
        $booking->payment_method = $request->issuer ?? $request->va_numbers[0]['bank'] ?? $request->payment_type ?? null;
        $booking->transaction_id = $request->transaction_id;
        $booking->paid_at = in_array($request->transaction_status, ['settlement', 'capture']) ? now() : null;

        $booking->save();

        Log::info('>> MIDTRANS CALLBACK DISIMPAN', $booking->toArray());

        return response()->json(['message' => 'Callback processed'], 200);
    }
}
