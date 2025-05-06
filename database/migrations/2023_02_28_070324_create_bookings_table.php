<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('number_phone');
            $table->string('ktp'); // Kolom KTP
            $table->string('paspor')->nullable(); // Kolom Paspor opsional

            // Relasi ke travel_packages
            $table->foreignId('travel_package_id')->constrained()->cascadeOnDelete();

            // Tambahkan relasi ke users
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Dari add_order_Id
            $table->string('order_id')->unique()->after('id')->nullable(false);

            // Dari add_payment_field
            $table->string('payment_status')->default('pending')->after('user_id'); // success / pending / failed
            $table->string('payment_method')->nullable()->after('payment_status');   // e.g., gopay, qris, etc
            $table->string('payment_type')->nullable()->after('payment_method');     // e.g., qris, permata, etc
            $table->string('transaction_id')->nullable()->after('payment_type');
            // $table->string('payment_token')->nullable()->after('transaction_id');   // snap token
            $table->timestamp('paid_at')->nullable()->after('transaction_id');       // waktu dibayar

            // Dari add_payment
            $table->integer('amount_paid')->nullable()->after('payment_status'); // DP
            $table->integer('remaining_balance')->nullable()->after('amount_paid'); // Sisa bayar

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
