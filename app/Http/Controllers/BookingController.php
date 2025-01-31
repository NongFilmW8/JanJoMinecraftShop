<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookingController extends Controller
{

        // แสดงรายการการจอง
        public function index(Request $request)
        {
            $query = $request->input('search');

            $bookings = Booking::when($query, function ($q) use ($query) {
                return $q->where('guest_name', 'like', "%{$query}%")
                        ->orWhere('room_number', 'like', "%{$query}%");
            })->paginate(10);

            return Inertia::render('Bookings/Index', [
                'bookings' => $bookings, // ไม่ต้องแปลงเป็น array
                'query' => $query,
            ]);
        }

    // แสดงฟอร์มจองห้อง
    public function create()
    {
        return Inertia::render('Bookings/Create');
    }

    // บันทึกการจอง
    public function store(Request $request)
    {
        $request->validate([
            'guest_name' => 'required|string|max:255',
            'room_id' => 'required|string|max:255',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date',
            'total_price' => 'required|numeric',
        ]);
        Booking::create([
            'guest_name' => $request->guest_name,
            'room_number' => $request->room_number,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'total_price' => $request->total_price,
        ]);
        return redirect()->route('bookings.index')->with('success', 'การจองสำเร็จ!');
    }

    // แสดงรายละเอียดของการจอง
    public function show(Booking $booking)
    {
        return Inertia::render('Bookings/Show', [
            'booking' => $booking,
        ]);
    }
}
