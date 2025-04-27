<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    private const CHUNK_SIZE = 1000;

    public function run()
    {
        $jsonPath = database_path('data/geography.json');
        
        if (!File::exists($jsonPath)) {
            $this->command->error('geography.json not found in database/data directory');
            return;
        }

        $jsonData = json_decode(File::get($jsonPath), true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->command->error('Invalid JSON format in geography.json');
            return;
        }

        $totalCount = count($jsonData);
        $chunks = array_chunk($jsonData, self::CHUNK_SIZE);
        $processedCount = 0;

        $this->command->info("Starting to seed {$totalCount} locations in chunks of " . self::CHUNK_SIZE);

        foreach ($chunks as $index => $chunk) {
            DB::beginTransaction();
            
            try {
                $locations = array_map(function ($item) {
                    return [
                        'full_name' => implode(':', array_filter([
                            strtolower($item['subdistrictNameEn'] ?? null),
                            strtolower($item['districtNameEn'] ?? null),
                            strtolower($item['provinceNameEn'] ?? null)
                        ])),
                        'zipcode' => $item['postalCode'] ?? null,
                        'province' => $item['provinceNameEn'] ?? null,
                        'sub_district' => $item['subdistrictNameEn'] ?? null,
                        'district' => $item['districtNameEn'] ?? null,
                    ];
                }, $chunk);

                // Bulk insert the chunk
                Location::insert($locations);
                
                DB::commit();
                
                $processedCount += count($chunk);
                $progress = round(($processedCount / $totalCount) * 100, 2);
                $this->command->info("Processed chunk " . ($index + 1) . " of " . count($chunks) . " ({$progress}%)");
                
            } catch (\Exception $e) {
                DB::rollBack();
                $this->command->error("Error processing chunk " . ($index + 1) . ": " . $e->getMessage());
                throw $e;
            }
        }

        $this->command->info("Successfully created {$processedCount} locations from geography.json");
    }
} 