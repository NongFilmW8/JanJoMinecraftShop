<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $table = 'roomtype'; // ถ้าชื่อตารางในฐานข้อมูลเป็น 'roomstype'

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'roomstype_id');
    }
}
