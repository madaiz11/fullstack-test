<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\Location;
use App\Models\PropertyType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition()
    {
        // Create location and property type if they don't exist
        $location = Location::first() ?? Location::factory()->create();
        $propertyType = PropertyType::first() ?? PropertyType::factory()->create();

        return [
            'id' => Str::uuid(),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraphs(3, true),
            'size_w' => $this->faker->randomFloat(2, 10, 100),
            'size_h' => $this->faker->randomFloat(2, 10, 100),
            'price' => $this->faker->numberBetween(1000000, 50000000),
            'date_listed' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'status' => $this->faker->randomElement(['forsale', 'sold']),
            'location_id' => $location->id,
            'property_type_id' => $propertyType->id,
        ];
    }
} 