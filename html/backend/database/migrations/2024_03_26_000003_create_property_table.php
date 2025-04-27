<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 255)->index();
            $table->longText('description')->nullable();
            $table->float('size_w')->nullable();
            $table->float('size_h')->nullable();
            $table->bigInteger('price');
            $table->dateTime('date_listed');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->string('status', 10);
            $table->foreignId('location_id')->constrained('location')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('property_type_id')->constrained('property_type')->cascadeOnDelete()->cascadeOnUpdate();
        });

        // Add check constraint for status after table creation
        DB::statement("ALTER TABLE property ADD CONSTRAINT chk_property_status CHECK (
            status IN ('forsale', 'sold')
        )");
    }

    public function down()
    {
        Schema::dropIfExists('property');
    }
}; 