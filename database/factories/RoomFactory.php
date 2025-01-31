<?php

namespace Database\Factories;

use App\Models\Room; // แก้เป็นโมเดล Room
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory // แก้ชื่อคลาสเป็น RoomFactory
{
    protected $model = Room::class;

    public function definition()
    {
        return [
            'room_number' => $this->faker->unique()->numberBetween(100, 999),
            'room_type_id' => \App\Models\RoomType::factory(), // สร้าง RoomType อัตโนมัติ
            'status' => $this->faker->randomElement(['available', 'occupied']),
        ];
    }
}
