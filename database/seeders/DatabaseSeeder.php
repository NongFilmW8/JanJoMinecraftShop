<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        \App\Models\Product::create([
            'name' => 'Diamond Sword',
            'price' => 99.99,
            'description' => 'A powerful sword made of diamond',
            'image' => 'minecraft-1-logo-pack/NormalID.png'
        ]);

        \App\Models\Product::create([
            'name' => 'Iron Pickaxe',
            'price' => 49.99,
            'description' => 'Durable mining tool',
            'image' => 'images/iron_pickaxe.jpg'
        ]);
    }
}
