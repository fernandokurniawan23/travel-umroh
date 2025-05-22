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
            $table->string('ktp')->nullable(); // Kolom KTP opsional
            $table->string('paspor')->nullable(); // Kolom Paspor opsional
            $table->string('vaccine_document')->nullable()->after('paspor');

            // Relasi ke travel_packages
            $table->foreignId('travel_package_id')->constrained()->cascadeOnDelete();

            // Tambahkan relasi ke users
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Dari add_order_Id
            $table->string('order_id')->unique()->after('id')->nullable(false);

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
