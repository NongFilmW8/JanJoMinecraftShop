<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Seeder;


class RoomSeeder extends Seeder
{
    public function run()
    {
        Room::factory()->count(15)->create(); // สร้างห้องพัก 10 ห้อง
    }
}
