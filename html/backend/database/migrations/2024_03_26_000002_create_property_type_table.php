<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('property_type', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
        });
        
        // Add check constraint for property type names after table creation
        DB::statement("ALTER TABLE property_type ADD CONSTRAINT chk_property_type_name CHECK (
            name IN ('home', 'condo', 'townhouse', 'land', 'shophouse', 'office', 'apartment', 'hotel')
        )");
    }

    public function down()
    {
        Schema::dropIfExists('property_type');
    }
}; 