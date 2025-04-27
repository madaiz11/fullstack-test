<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyTypeSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Starting to seed property types...');

        DB::beginTransaction();
        try {
            $types = PropertyType::TYPES;
            $records = array_map(fn($type) => ['name' => $type], $types);
            
            PropertyType::insert($records);
            
            DB::commit();
            $this->command->info('Successfully created ' . count($types) . ' property types');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error("Error creating property types: " . $e->getMessage());
            throw $e;
        }
    }
} 