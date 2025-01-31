<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // แสดงรายการห้องพัก
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    // แสดงฟอร์มจองห้อง
    public function create()
    {
        return view('bookings.create');
    }

    // บันทึกการจอง
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        Booking::create($request->all());

        return redirect()->route('bookings.show')->with('success', 'การจองสำเร็จ!');
    }

    // แสดงรายการการจอง
    public function show()
    {
        $bookings = Booking::all();
        return view('bookings.show', compact('bookings'));
    }
}
