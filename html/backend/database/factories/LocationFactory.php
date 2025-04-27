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
            'full_name' => $this->faker->city(),
            'zipcode' => $this->faker->numerify('#####'),
            'province' => $this->faker->city(),
            'sub_district' => $this->faker->city(),
            'district' => $this->faker->city(),
        ];
    }
} 