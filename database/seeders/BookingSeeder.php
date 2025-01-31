<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    // ดึงข้อมูลลูกค้าและห้องพักที่สร้างไว้แล้ว
    $customers = Customer::all();
    $rooms = Room::all();

        // สำหรับแต่ละลูกค้า ให้สร้างการจองสุ่ม 2-3 รายการ
        foreach ($customers as $customer) {
            foreach (range(1, rand(2, 3)) as $index) {
                Booking::factory()->create([
                    'customer_id' => $customer->id,
                    'room_id' => $rooms->random()->id,
                ]);
            }
        }
    }
}
