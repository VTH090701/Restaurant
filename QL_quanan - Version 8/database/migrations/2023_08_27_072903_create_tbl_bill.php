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
        Schema::create('hoadon', function (Blueprint $table) {
            $table->increments('hoadon_id');
            $table->integer('admin_id');
            $table->integer('ban_id');
            $table->integer('khachhang_id');
            $table->string('hoadon_tinhtrang');
            $table->string('hoadon_tongtien');
            $table->string('hoadon_ghichu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoadon');
    }
};
