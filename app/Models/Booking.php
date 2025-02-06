<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory; // This trait is required to use factories

    // Define fillable fields or relationships if needed
    protected $fillable = [
        'guest_name',
        'room_number',
        'check_in',
        'check_out',
        'total_price',
        'roomtype',  // เอาไว้เก็บประเภทห้อง

    ];

    public function roomType()
    {
        // return $this->belongsTo(RoomType::class);
    }

    public function customer()
    {
        // return $this->belongsTo(Customer::class, 'customer_id');
}
}
