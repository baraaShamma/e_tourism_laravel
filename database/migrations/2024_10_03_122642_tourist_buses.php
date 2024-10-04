<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tourist_buses', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->integer('bus_number')->unique()->unsigned()->length(6); // Bus number (max 6 digits)
            $table->string('bus_type', 50); // Bus type (like "luxury", "standard", etc.)
            $table->integer('seat_count')->unsigned(); // Seat count
            $table->boolean('bus_status')->default(1); // Bus status (1 for active, 0 for inactive)
            $table->timestamps(); // Created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tourist_buses');
    }
};
