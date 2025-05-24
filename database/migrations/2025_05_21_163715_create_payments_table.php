<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete(); // relasi ke bookings
            $table->integer('amount'); // jumlah pembayaran
            $table->string('method'); // metode pembayaran: cash, transfer, dll
            $table->string('status')->default('paid'); // paid / pending (default paid)
            $table->timestamp('payment_date')->nullable(); // tanggal pembayaran
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

