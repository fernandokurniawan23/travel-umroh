<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;

class BookingController extends Controller
{
    public function store(BookingRequest $request)
    {
        // Simpan file KTP ke dalam storage
        $ktpPath = $request->file('ktp')->store('ktp_uploads', 'public');

        // Simpan file Paspor jika diunggah (opsional)
        $pasporPath = $request->hasFile('paspor') 
            ? $request->file('paspor')->store('paspor_uploads', 'public') 
            : null;

        // Simpan data ke database
        Booking::create([
            'name' => $request->name,
            'email' => $request->email,
            'number_phone' => $request->number_phone,
            'travel_package_id' => $request->travel_package_id,
            'ktp' => $ktpPath, // Simpan path file KTP
            'paspor' => $pasporPath, // Simpan path file Paspor (jika ada)
        ]);

        return redirect()->back()->with([
            'message' => "Success, we'll process your booking"
        ]);
    }
}
