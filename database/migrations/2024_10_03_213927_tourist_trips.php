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
        Schema::create('tourist_trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tourist_program_id')->constrained('tourist_programs')->onDelete('cascade');
            $table->foreignId('bus_id')->constrained('tourist_buses')->onDelete('cascade');
            $table->foreignId('guide_id')->constrained('users')->onDelete('cascade');
            $table->decimal('price', 8, 2);
            $table->integer('max_capacity');
            $table->date('trip_date');
            $table->timestamps();
        });
            }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourist_trips'); // حذف الجدول إذا تم تنفيذ rollback
    }
};
