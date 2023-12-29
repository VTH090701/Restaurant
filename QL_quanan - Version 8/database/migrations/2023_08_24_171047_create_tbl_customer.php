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
        Schema::create('khanhhang', function (Blueprint $table) {
            $table->increments('khanhhang_id');
            $table->string('khanhhang_ten');
            $table->string('khanhhang_sdt');
            $table->string('khanhhang_email');
            $table->string('khanhhang_diachi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khanhhang');
    }
};
