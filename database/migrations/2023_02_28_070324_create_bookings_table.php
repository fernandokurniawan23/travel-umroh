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
            $table->string('order_id')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('number_phone');
            $table->string('ktp')->nullable();
            $table->string('paspor')->nullable();
            $table->string('vaccine_document')->nullable();
            $table->bigInteger('travel_package_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('shipment_receipt')->nullable();
            $table->string('shipment_info')->nullable();
            $table->timestamps(); // Ini akan membuat kolom 'created_at' dan 'updated_at'
            $table->tinyInteger('user_receipt_confirmation')->default(0);

            $table->foreign('travel_package_id')->references('id')->on('travel_packages')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
