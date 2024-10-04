<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_driver', function (Blueprint $table) {
            $table->id(); // معرف الربط (مفتاح رئيسي)
            $table->foreignId('bus_id')->constrained('buses')->onDelete('cascade'); // id الحافلة
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // id السائق
            $table->timestamps(); // الحقول الافتراضية created_at و updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bus_driver'); // حذف الجدول إذا تم تنفيذ rollback
    }
};
