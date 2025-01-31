<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory; // This trait is required to use factories

    // Define fillable fields or relationships if needed
    protected $fillable = [
        'room_id',
        'customer_id',
        'check_in_date',
        'check_out_date',
        'total_price',
    ];
}
