<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $bookings = Booking::with('travel_package')->orderByDesc('created_at');

        if ($search) {
            $bookings->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhereHas('travel_package', function ($query) use ($search) {
                        $query->where('type', 'like', '%' . $search . '%');
                    });
            });
        }

        $bookings = $bookings->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $travelPackages = \App\Models\TravelPackage::all();
        return view('admin.bookings.create', compact('travelPackages'));
    }

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

        if ($request->hasFile('receipt_confirmation')) {
            $data['receipt_confirmation'] = $request->file('receipt_confirmation')->store('uploads/bukti_penerimaan', 'public');
        }

        $data['user_id'] = auth()->id();

        $booking = Booking::create($data);

        // Generate order_id
        $orderId = 'MNL-' . $booking->id . '-' . now()->format('YmdHi');
        $booking->update(['order_id' => $orderId]);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Booking $booking)
    {
        $travelPackages = \App\Models\TravelPackage::all();
        return view('admin.bookings.edit', compact('booking', 'travelPackages'));
    }

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
            'description' => 'nullable|string|max:500',
            'receipt_status' => 'nullable|string|in:menunggu,dikirim,diterima', // Validasi status
            'user_receipt_confirmation' => 'nullable|boolean', // Validasi konfirmasi admin
        ]);

        $data = $request->all();

        // Tangani upload file seperti sebelumnya
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

        if ($request->hasFile('receipt_confirmation')) {
            if ($booking->receipt_confirmation) {
                \Illuminate\Support\Facades\Storage::delete('public/' . $booking->receipt_confirmation);
            }
            $data['receipt_confirmation'] = $request->file('receipt_confirmation')->store('uploads/bukti_penerimaan', 'public');
        }

        // Pastikan status penerimaan dan konfirmasi admin ikut diupdate
        $booking->update($data);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil dihapus.');
    }
}
