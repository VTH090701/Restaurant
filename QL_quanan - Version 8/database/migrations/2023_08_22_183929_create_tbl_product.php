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
        Schema::create('sanpham', function (Blueprint $table) {
            $table->increments('sp_id');
            $table->integer('danhmuc_id');
            $table->text('sp_mota');
            $table->text('sp_noidung');
            $table->string('sp_ten');
            $table->string('sp_gia');
            $table->string('sp_hinhanh');
            $table->string('sp_tinhtrang');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sanpham');
    }
};
