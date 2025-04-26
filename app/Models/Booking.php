<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function travel_package()
    {
        return $this->belongsTo(TravelPackage::class);
    }

    //relasi ke user (bisa dihapus)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
