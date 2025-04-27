<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('property_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('property_id')->constrained('property')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name', 60);
            $table->integer('amount')->default(1);
        });

        // Add check constraint for attribute names after table creation
        DB::statement("ALTER TABLE property_attributes ADD CONSTRAINT chk_property_attributes_name CHECK (
            name IN (
                'airconditioner', 'wardroberoom', 'lift', 'parking',
                'fitness', 'jagucci', 'swimmingpool', 'park area',
                'cctv', 'shuttle service'
            )
        )");
    }

    public function down()
    {
        Schema::dropIfExists('property_attributes');
    }
}; 