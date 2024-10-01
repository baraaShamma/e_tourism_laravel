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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fName', 50);
            $table->string('lName', 50);
            $table->string('email', 191)->unique(); // تأكد من تقليل طول البريد الإلكتروني إلى 191
            $table->string('password');
            $table->enum('type_user', ['admin', 'tourist', 'guide', 'driver']);
            $table->string('address')->nullable();
            $table->string('mobile', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
