<?php

namespace Database\Factories;

use App\Models\PropertyAttribute;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyAttributeFactory extends Factory
{
    protected $model = PropertyAttribute::class;

    public function definition(): array
    {
        return [
            'property_id' => Property::factory(),
            'name' => fake()->randomElement(PropertyAttribute::ATTRIBUTES),
            'amount' => fake()->numberBetween(1, 5),
        ];
    }
} 