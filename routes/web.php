<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\TravelPackageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TravelPackageController as PublicTravelPackageController;
use App\Http\Controllers\BlogController as PublicBlogController;
use App\Http\Controllers\BookingController as PublicBookingController;
// use App\Http\Controllers\PaymentController as MidtransPaymentController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\ProfileController as PublicProfileController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('homepage');

// Travel Packages (Public)
Route::get('travel-packages', [PublicTravelPackageController::class, 'index'])->name('travel_package.index');
Route::get('travel-packages/{travel_package:slug}', [PublicTravelPackageController::class, 'show'])->name('travel_package.show');

// Blogs (Public)
Route::get('blogs', [PublicBlogController::class, 'index'])->name('blog.index');
Route::get('blogs/{blog:slug}', [PublicBlogController::class, 'show'])->name('blog.show');
Route::get('blogs/category/{category:slug}', [PublicBlogController::class, 'category'])->name('blog.category');

// Contact
Route::get('contact', fn() => view('contact'))->name('contact');

// Booking (Public - Store memerlukan auth)
Route::post('booking', [PublicBookingController::class, 'store'])->name('booking.store')->middleware('auth');

// Pembayaran Midtrans Sukses
// Route::get('/payment/success', [MidtransPaymentController::class, 'success']);

Auth::routes(['register' => true]);

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi telah dikirim ulang!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Dashboard: semua role internal
Route::middleware(['auth', 'role:administrator,ketua,sekretaris,bendahara,administrasi'])
    ->prefix('admin')->as('admin.')
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

// Users:
// Ketua administrator dan administrasi bisa akses index
Route::middleware(['auth', 'role:administrator,ketua,administrasi'])
    ->prefix('admin')->as('admin.')
    ->group(function () {
        Route::resource('users', UserController::class)->only(['index']);
    });


// Khusus adminstrator: create, store, edit, update, destroy
Route::middleware(['auth', 'role:administrator'])
    ->prefix('admin')->as('admin.')
    ->group(function () {
        Route::resource('users', UserController::class)->except(['index', 'show']);
    });

// Booking:
// Semua role bisa lihat daftar booking
Route::middleware(['auth', 'role:administrator,administrasi,ketua,sekretaris,bendahara'])
    ->prefix('admin')->as('admin.')
    ->group(function () {
        Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
    });

//payment
Route::middleware(['auth', 'role:administrator,administrasi,ketua,sekretaris,bendahara'])
    ->prefix('admin')->as('admin.')
    ->group(function () {
        Route::get('payments', [\App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('payments.index');
        Route::get('bookings/{booking}/payments', [\App\Http\Controllers\Admin\PaymentController::class, 'getBookingPayments'])->name('bookings.payments');
        Route::get('bookings/{booking}/details', [\App\Http\Controllers\Admin\PaymentController::class, 'getBookingDetails'])->name('bookings.details');
    });

Route::middleware(['auth', 'role:administrator,administrasi,bendahara'])
    ->prefix('admin')->as('admin.')
    ->group(function () {
        Route::resource('payments', \App\Http\Controllers\Admin\PaymentController::class)->except(['index']);
    });

Route::middleware(['auth', 'role:administrator,administrasi,bendahara'])
    ->prefix('admin')->as('admin.')
    ->group(function () {
        Route::get('payments/{payment}/edit', [\App\Http\Controllers\Admin\PaymentController::class, 'edit'])->name('payments.edit');
        Route::put('payments/{payment}', [\App\Http\Controllers\Admin\PaymentController::class, 'update'])->name('payments.update');
        Route::patch('payments/{payment}', [\App\Http\Controllers\Admin\PaymentController::class, 'update']); // Optional untuk payments
    });

// administrator & administrasi full akses (tanpa index)
Route::middleware(['auth', 'role:administrator,administrasi'])
    ->prefix('admin')->as('admin.')
    ->group(function () {
        Route::get('bookings/create', [BookingController::class, 'create'])->name('bookings.create');
        Route::post('bookings', [BookingController::class, 'store'])->name('bookings.store');
        Route::get('bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
        Route::delete('bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
        Route::get('bookings/{booking}/details', [PaymentController::class, 'getBookingDetails'])->name('bookings.details');
    });

// administrator, administrasi, bendahara bisa edit dan update
Route::middleware(['auth', 'role:administrator,administrasi,bendahara'])
    ->prefix('admin')->as('admin.')
    ->group(function () {
        Route::get('bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
        Route::put('bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
        Route::patch('bookings/{booking}', [BookingController::class, 'update']); // Optional
    });


// Travel Package:
Route::middleware(['auth', 'role:administrator,ketua,sekretaris'])
    ->prefix('admin')->as('admin.')
    ->group(function () {
        Route::resource('travel_packages', TravelPackageController::class)->only(['index']);
        Route::resource('travel_packages.galleries', \App\Http\Controllers\Admin\GalleryController::class)->only(['index']);
    });

Route::middleware(['auth', 'role:administrator'])
    ->prefix('admin')->as('admin.')
    ->group(function () {
        Route::resource('travel_packages', TravelPackageController::class)->except(['index', 'show']);
        Route::resource('travel_packages.galleries', \App\Http\Controllers\Admin\GalleryController::class)->except(['index', 'show']);
    });


// Blog Category dan Blog:
// Ketua - hanya bisa melihat (read only)
Route::middleware(['auth', 'role:ketua,administrator,administrasi'])
    ->prefix('admin')->as('admin.')
    ->group(function () {
        Route::resource('categories', CategoryController::class)->only(['index']);
        Route::resource('blogs', BlogController::class)->only(['index']);
        // Rute untuk menampilkan gambar blog (mungkin index jika diperlukan di masa depan)
        Route::resource('blogs.images', \App\Http\Controllers\Admin\BlogImageController::class)->only(['index']);
    });

// Administrator - full access
Route::middleware(['auth', 'role:administrator,administrasi'])
    ->prefix('admin')->as('admin.')
    ->group(function () {
        // ... route lainnya ...
        Route::resource('categories', CategoryController::class)->except(['index', 'show']);;
        Route::resource('blogs', BlogController::class)->except(['index', 'show']);;
        // Rute untuk menyimpan gambar blog
        Route::post('blogs/{blog}/images', [\App\Http\Controllers\Admin\BlogImageController::class, 'store'])->name('blogs.images.store');
        // Rute untuk menghapus gambar blog
        Route::delete('blogs/{blog}/images/{blog_image}', [\App\Http\Controllers\Admin\BlogImageController::class, 'destroy'])->name('blogs.images.destroy');
    });


// Profile: semua role internal
Route::middleware(['auth', 'role:administrator,ketua,sekretaris,bendahara,administrasi'])
    ->prefix('admin')->as('admin.')
    ->group(function () {
        Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    });

// Profile dan Histori Pembayaran (untuk user yang login)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [\App\Http\Controllers\PublicProfileController::class, 'show'])->name('user.profile.show');
    Route::get('/profile/payments', [\App\Http\Controllers\PublicProfileController::class, 'paymentHistory'])->name('user.profile.payments');
});