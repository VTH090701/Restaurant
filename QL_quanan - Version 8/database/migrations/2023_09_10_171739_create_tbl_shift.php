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
        Schema::create('phienlamviec', function (Blueprint $table) {
            $table->increments('phienlamviec_id');
            $table->integer('admin_id');
            //$table->integer('order_id');
            $table->string('phienlamviec_tt');
            $table->string('phienlamviec_dt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phienlamviec');
    }
};
