<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('location', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 200)->index();
            $table->string('zipcode', 5)->nullable();
            $table->string('province', 60)->nullable();
            $table->string('sub_district', 60)->nullable();
            $table->string('district', 60)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('location');
    }
}; 