<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // สร้างผู้ใช้ทดสอบ 1 คน
        User::firstOrCreate(
        [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // ตั้งรหัสผ่าน

        ]);

        // เรียกใช้ Seeders อื่นๆ ที่จำเป็น
        $this->call([
        RoomTypeSeeder::class, // เรียกก่อนเพื่อสร้างประเภทห้อง
        CustomerSeeder::class, // สร้างลูกค้า
        RoomSeeder::class,     // สร้างห้องพัก
        BookingSeeder::class   // สร้างการจอง
        ]);
    }
}
