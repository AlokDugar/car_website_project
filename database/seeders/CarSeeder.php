<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Car::create([
            'maker_id' => 1,
            'model_id' => 1, // Correct column name
            'year' => 1973,
            'price' => 87000,
            'vin' => 'RCVCNGMWBYSIZMS0G',
            'mileage' => 310000,
            'car_type_id' => 3,
            'fuel_type_id' => 2,
            'user_id' => 1,
            'city_id' => 8,
            'address' => '22478 Schowalter View, East Carolina, NH 00377-3224',
            'phone' => '62741914',
            'description' => 'Deserunt voluptatem odio veritatis neque...',
            'published_at' => now(),
        ]);
    }
}
