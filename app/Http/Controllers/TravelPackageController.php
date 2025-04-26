<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelPackage;

class TravelPackageController extends Controller
{
    public function index()
    {
        // Ambil semua travel package beserta galerinya untuk ditampilkan di halaman index
        $travel_packages = TravelPackage::with('galleries')->get();

        return view('travel_packages.index', compact('travel_packages'));
    }

    public function show(TravelPackage $travel_package)
    {
        // Pastikan relasi galleries dimuat agar gambar muncul di show.blade.php
        $travel_package->load('galleries');

        // Ambil travel package lain untuk ditampilkan sebagai rekomendasi
        $travel_packages = TravelPackage::where('id', '!=', $travel_package->id)
                                        ->with('galleries') // agar thumbnail muncul di bagian bawah
                                        ->get();

        return view('travel_packages.show', compact('travel_package', 'travel_packages'));
    }
}
