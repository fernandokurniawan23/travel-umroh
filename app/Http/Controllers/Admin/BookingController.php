<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('travel_package')->orderByDesc('created_at')->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $travelPackages = \App\Models\TravelPackage::all();
        return view('admin.bookings.create', compact('travelPackages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'travel_package_id' => 'required|exists:travel_packages,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'number_phone' => 'required|string|max:20',
            'ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'paspor' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vaccine_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'payment_status' => 'nullable|string|max:50',
            'amount_paid' => 'nullable|numeric',
            'remaining_balance' => 'nullable|numeric',
            'payment_method' => 'nullable|string|max:50',
            'payment_type' => 'nullable|string|max:50',
            'transaction_id' => 'nullable|string|max:255',
            'paid_at' => 'nullable|date',
        ]);

        $data = $request->all();

        if ($request->hasFile('ktp')) {
            $data['ktp'] = $request->file('ktp')->store('uploads/ktp', 'public');
        }

        if ($request->hasFile('paspor')) {
            $data['paspor'] = $request->file('paspor')->store('uploads/paspor', 'public');
        }

        if ($request->hasFile('vaccine_document')) {
            $data['vaccine_document'] = $request->file('vaccine_document')->store('uploads/vaccine_document', 'public');
        }

        $data['user_id'] = auth()->id();

        // Buat booking terlebih dahulu untuk mendapatkan ID
        $booking = Booking::create($data);

        // Format order_id
        $orderId = 'MNL-' . $booking->id . '-' . now()->format('YmdHi');
        $booking->update(['order_id' => $orderId]);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $travelPackages = \App\Models\TravelPackage::all();
        return view('admin.bookings.edit', compact('booking', 'travelPackages'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'travel_package_id' => 'required|exists:travel_packages,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'number_phone' => 'required|string|max:20',
            'ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'paspor' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vaccine_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'payment_status' => 'nullable|string|max:50',
            'amount_paid' => 'nullable|numeric',
            'remaining_balance' => 'nullable|numeric',
            'payment_method' => 'nullable|string|max:50',
            'payment_type' => 'nullable|string|max:50',
            'transaction_id' => 'nullable|string|max:255',
            'paid_at' => 'nullable|date',
        ]);

        $data = $request->all();

        if ($request->hasFile('ktp')) {
            if ($booking->ktp) {
                \Illuminate\Support\Facades\Storage::delete('public/' . $booking->ktp);
            }
            $data['ktp'] = $request->file('ktp')->store('uploads/ktp', 'public');
        }

        if ($request->hasFile('paspor')) {
            if ($booking->paspor) {
                \Illuminate\Support\Facades\Storage::delete('public/' . $booking->paspor);
            }
            $data['paspor'] = $request->file('paspor')->store('uploads/paspor', 'public');
        }

        if ($request->hasFile('vaccine_document')) {
            if ($booking->vaccine_document) {
                \Illuminate\Support\Facades\Storage::delete('public/' . $booking->vaccine_document);
            }
            $data['vaccine_document'] = $request->file('vaccine_document')->store('uploads/vaccine_document', 'public');
        }

        $booking->update($data);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil dihapus.');
    }
}
