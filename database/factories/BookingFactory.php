<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(), // สร้างลูกค้าใหม่
            'room_id' => Room::factory(), // สร้างห้องใหม่
            'check_in' => $this->faker->dateTimeBetween('now', '+1 week'), // วันที่เช็คอิน
            'check_out' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'), // วันที่เช็คเอาท์
            'total_price' => $this->faker->randomFloat(2, 50, 500),

        ];
    }
}
