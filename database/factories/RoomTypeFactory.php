<?php

namespace Database\Factories;

use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomTypeFactory extends Factory
{
    protected $model = RoomType::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'price_per_night' => $this->faker->numberBetween(1000, 5000), // แก้เป็น price_per_night
            'description' => $this->faker->sentence(),
        ];
    }
}
