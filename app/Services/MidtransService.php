<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createTransaction($booking)
    {
        $orderId = 'DP-' . $booking->id . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => 1000000, // DP Rp1.000.000
            ],
            'customer_details' => [
                'first_name' => $booking->name,
                'email' => $booking->email,
                'phone' => $booking->number_phone,
            ],
            'item_details' => [
                [
                    'id' => 'DP-' . $booking->id,
                    'price' => 1000000,
                    'quantity' => 1,
                    'name' => $booking->travel_package->type ?? 'DP Paket Umroh'
                ]
            ],
            'callbacks' => [
                'finish' => url('/payment/success'),
            ],
        ];

        return [
            'snap_url' => Snap::getSnapUrl($params),
            'order_id' => $orderId,
        ];
    }
}
