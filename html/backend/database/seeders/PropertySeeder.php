<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\PropertyAttribute;
use App\Models\Location;
use App\Models\PropertyType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    private const PROPERTIES_COUNT = 128;
    private const CHUNK_SIZE = 20;
    private const MIN_ATTRIBUTES = 2;
    private const MAX_ATTRIBUTES = 5;

    public function run(): void
    {
        // Check for required data
        if (Location::count() === 0) {
            $this->command->error('No locations found. Please run LocationSeeder first.');
            return;
        }

        if (PropertyType::count() === 0) {
            $this->command->error('No property types found. Please run PropertyTypeSeeder first.');
            return;
        }

        $this->command->info('Starting to seed ' . self::PROPERTIES_COUNT . ' properties...');

        // Cache location and property type IDs to avoid repeated queries
        $locationIds = Location::pluck('id')->toArray();
        $propertyTypeIds = PropertyType::pluck('id')->toArray();

        $chunks = array_chunk(range(1, self::PROPERTIES_COUNT), self::CHUNK_SIZE);
        $processedCount = 0;

        foreach ($chunks as $index => $chunk) {
            DB::beginTransaction();
            try {
                // Create properties in chunks
                $properties = Property::factory()
                    ->count(count($chunk))
                    ->create([
                        'location_id' => fn() => fake()->randomElement($locationIds),
                        'property_type_id' => fn() => fake()->randomElement($propertyTypeIds),
                    ]);

                // Add random attributes to each property
                foreach ($properties as $property) {
                    $attributeCount = fake()->numberBetween(self::MIN_ATTRIBUTES, self::MAX_ATTRIBUTES);
                    $attributes = fake()->randomElements(
                        PropertyAttribute::ATTRIBUTES,
                        $attributeCount
                    );

                    foreach ($attributes as $attribute) {
                        PropertyAttribute::create([
                            'property_id' => $property->id,
                            'name' => $attribute,
                            'amount' => fake()->numberBetween(1, 5)
                        ]);
                    }
                }

                DB::commit();

                $processedCount += count($chunk);
                $progress = round(($processedCount / self::PROPERTIES_COUNT) * 100, 2);
                $this->command->info("Processed chunk " . ($index + 1) . " of " . count($chunks) . " ({$progress}%)");

            } catch (\Exception $e) {
                DB::rollBack();
                $this->command->error("Error processing chunk " . ($index + 1) . ": " . $e->getMessage());
                throw $e;
            }
        }

        $this->command->info("Successfully created {$processedCount} properties with attributes");
    }
} 