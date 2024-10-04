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
        Schema::create('tourist_programs', function (Blueprint $table): void {
            $table->id(); // معرف البرنامج السياحي (مفتاح رئيسي)
            $table->string('type', 100); // نوع البرنامج السياحي (مثل جولة سياحية، مغامرة، ...)
            $table->string('name', 150); // اسم البرنامج السياحي
            $table->text('description')->nullable(); // وصف مفصل للبرنامج السياحي
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
        Schema::dropIfExists('tourist_programs'); // حذف الجدول إذا تم تنفيذ rollback
    }
};
