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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('name')->comment('ชื่อ-นามสกุล');
            $table->string('nick_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('type')->default(0);//0=emp, 1=pm, 2=hr, 3=ceo
            $table->string('position')->nullable()->comment("ตำแหน่ง");

            $table->string('password')->nullable();
            $table->timestamp('birthday')->nullable()->comment("วันเกิด");
            $table->string('address')->nullable();
            $table->string('phone_no_1')->nullable();
            $table->string('phone_no_2')->nullable();
            $table->string('profile_img')->nullable();
            $table->string('signature')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
