<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    public function run()
    {
        // สร้างประเภทห้องพัก 3 แบบ
        RoomType::factory()->count(3)->create();
    }
}
