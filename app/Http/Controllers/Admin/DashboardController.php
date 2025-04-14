<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TravelPackage;
use App\Models\Booking;
use App\Models\Blog;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalPackages = TravelPackage::count();
        $totalBookings = Booking::count();
        $totalBlogs = Blog::count();

        // Booking per paket
        $bookingData = Booking::selectRaw('travel_package_id, COUNT(id) as total')
            ->groupBy('travel_package_id')
            ->with('travel_package')
            ->get();

        $labels = $bookingData->map(fn($b) => $b->travel_package->type);
        $values = $bookingData->pluck('total');

        // Inisialisasi array default 12 bulan (agar tidak undefined)
        $bookingsPerMonth = array_fill(1, 12, 0);

        // Ambil data booking per bulan dari database
        $queryResult = Booking::selectRaw('MONTH(created_at) as month, COUNT(id) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        // Gabungkan hasil query ke array default (jika ada datanya)
        foreach ($queryResult as $month => $total) {
            $bookingsPerMonth[$month] = $total;
        }

        // Konversi ke format yang bisa digunakan di Chart.js
        $months = [];
        $totals = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create()->month($i)->format('F'); // Nama bulan
            $totals[] = $bookingsPerMonth[$i]; // Data booking per bulan
        }

        return view('admin.dashboard', compact(
            'totalUsers', 'totalPackages', 'totalBookings', 'totalBlogs',
            'labels', 'values', 'months', 'totals'
        ));
    }
}