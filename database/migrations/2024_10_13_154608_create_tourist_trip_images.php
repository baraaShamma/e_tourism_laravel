<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tourist_trip_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tourist_trip_id');
            $table->string('image'); // مسار الصورة
    
            // علاقات
            $table->foreign('tourist_trip_id')->references('id')->on('tourist_trips')->onDelete('cascade');
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourist_trip_images');
    }
};
