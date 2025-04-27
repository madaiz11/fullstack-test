<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'size_w' => $this->faker->randomFloat(2, 10, 1000),
            'size_h' => $this->faker->randomFloat(2, 10, 1000),
            'price' => $this->faker->numberBetween(100000, 10000000),
            'date_listed' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'status' => $this->faker->randomElement(['forsale', 'sold']),
            'location_id' => Location::factory(),
            'property_type_id' => PropertyType::factory(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
} 