<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'email',
        'number_phone',
        'ktp',
        'paspor',
        'vaccine_document',
        'travel_package_id',
        'user_id',
        'order_id',
        'shipment_receipt',
        'shipment_info',
        'user_receipt_confirmation'
    ];


    public function travel_package()
    {
        return $this->belongsTo(TravelPackage::class);
    }

    //relasi ke user (bisa dihapus)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relasi ke payments
    public function payments()
{
    return $this->hasMany(Payment::class);
}

}

