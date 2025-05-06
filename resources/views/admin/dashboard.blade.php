@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ __('Dashboard') }}</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Total Users -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $totalUsers }}</h3>
                        <p>Total Users</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>

            <!-- Total Travel Packages -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalPackages }}</h3>
                        <p>Travel Packages</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-suitcase"></i>
                    </div>
                </div>
            </div>

            <!-- Total Bookings -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalBookings }}</h3>
                        <p>Total Bookings</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
            </div>

            <!-- Total Blogs -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $totalBlogs }}</h3>
                        <p>Total Blog Posts</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Booking per Paket -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">📊 Grafik Booking Per Paket</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="bookingChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Grafik Tren Booking per Bulan -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">📈 Tren Booking Per Bulan - {{ date('Y') }}</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="trendBookingChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Grafik Booking per Paket
        var ctx = document.getElementById('bookingChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels), // Nama paket
                datasets: [{
                    label: 'Jumlah Booking',
                    data: @json($values), // Total booking per paket
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Grafik Tren Booking per Bulan
        var ctx2 = document.getElementById('trendBookingChart').getContext('2d');
        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: @json($months), // Nama bulan
                datasets: [{
                    label: 'Jumlah Booking Per Bulan',
                    data: @json($totals), // Total booking per bulan
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection