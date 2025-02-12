<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Room; // เพิ่มบรรทัดนี้
use App\Models\Booking;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
class BookingController extends Controller
{

        // แสดงรายการการจอง
        public function index(Request $request)
{
    // ดึงข้อมูลการจอง
    $query = $request->input('search');
    $bookings = Booking::when($query, function ($q) use ($query) {
        return $q->where('guest_name', 'like', "%{$query}%")
            ->orWhere('room_number', 'like', "%{$query}%");
    })->paginate(10);

    // ดึงข้อมูลประเภทห้อง
    $roomTypes = ['Standard', 'Suite', 'VIP'];

    // ส่งข้อมูลไปยัง View
    return Inertia::render('Bookings/Index', [
        'bookings' => $bookings,
        'roomTypes' => $roomTypes,
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
        // dd($request->all()); // ดูค่าที่ React ส่งมาจริง ๆ
        $request->validate([
            'guest_name' => 'required|string|max:255',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after_or_equal:check_in',
            'roomtype' => 'required|string', // ตรวจสอบฟิลด์ roomtypes
            'room_number' => 'required|string', // ตรวจสอบฟิลด์ room_number
            'total_price' => 'required|numeric|min:0',
        ]);
// คำนวณจำนวนวันที่เข้าพัก
$days = Carbon::parse($request->check_in)->diffInDays(Carbon::parse($request->check_out));

// กำหนดราคาแต่ละประเภทห้อง (หรือดึงข้อมูลจากฐานข้อมูล)
$roomRates = [
    'Standard' => 1000, // ราคาเฉลี่ยของห้อง Standard
    'Suite' => 1500,    // ราคาเฉลี่ยของห้อง Suite
    'VIP' => 2000,      // ราคาเฉลี่ยของห้อง VIP
];

// คำนวณราคาโดยการคูณจำนวนคืนกับอัตราค่าห้อง
$roomRate = $roomRates[$request->roomtype] ?? 0; // เลือกราคาห้องตาม roomtype
$totalPrice = $roomRate * $days; // คำนวณราคาทั้งหมด




        // เพิ่มข้อมูลการจองในตาราง bookings
        Booking::create([
            'room_number' => $request->room_number,
            'guest_name' => $request->guest_name,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'roomtype' => $request->roomtype,
            'total_price' => $totalPrice, // ส่งค่าที่คำนวณแล้วไป
        ]);
        // dd('Booking created successfully!');


        return redirect()->route('bookings.index')->with('success', 'การจองสำเร็จ!');
    }

    // แสดงรายละเอียดของการจอง
    public function show(Booking $booking)
    {
        $roomType = DB::table('roomstype')->get()->toArray() ?: [];
        return Inertia::render('Bookings/Show', [
            'booking' => $booking,
            'roomType' => $roomType ?: [], // ใช้ค่าเริ่มต้นเป็นอาร์เรย์ว่างหากไม่มีข้อมูล
            'query' => request()->input('search', ''), // ใช้ค่าเริ่มต้นเป็น string ว่าง
        ]);
    }
    public function update(Request $request, Booking $booking)
    {
        $validatedData = $request->validate([
            'guest_name' => 'required|string|max:255',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'room_number' => 'required|string|max:255',
            'roomtype' => 'required|string|max:255',
            'total_price' => 'required|numeric',
        ]);

        $booking->update($validatedData);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }
    // Redirect with success message
    public function edit(Booking $booking)
    {
        return Inertia::render('Bookings/Update', [
            'booking' => $booking,
        ]);
    }



 /**
  * The code snippet contains PHP functions to edit and delete a booking record.
  *
  * @param id The "id" parameter in the code snippet refers to the unique identifier of a booking
  * record. It is used to retrieve or delete a specific booking entry from the database based on its
  * ID.
  *
  * @return In the `edit` function, an Inertia response is being returned with the view `Bookings/Edit`
  * and the booking data retrieved using `findOrFail` method.
  */


public function destroy($id)
{
    $booking = Booking::findOrFail($id);
    $booking->delete();

    return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
}

}
