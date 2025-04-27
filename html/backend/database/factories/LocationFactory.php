<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition(): array
    {
        return [
            'full_name' => fake()->address(),
            'zipcode' => fake()->postcode(),
            'province' => fake()->city(),
            'sub_district' => fake()->city(),
            'district' => fake()->city(),
        ];
    }
} 