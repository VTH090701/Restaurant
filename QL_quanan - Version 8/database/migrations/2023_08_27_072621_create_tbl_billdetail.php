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
        Schema::create('cthoadon', function (Blueprint $table) {
            $table->increments('cthoadon_id');
            $table->integer('hoadon_id');
            $table->integer('sp_id');
            $table->integer('cthoadon_slsp');
            $table->string('cthoadon_giasp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cthoadon');
    }
};
