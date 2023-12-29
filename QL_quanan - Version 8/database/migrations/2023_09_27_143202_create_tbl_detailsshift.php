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
        Schema::create('ctphienlamviec', function (Blueprint $table) {
            $table->increments('ctphien_id');
            $table->integer('phienlamviec_id');
            $table->string('ctphien_motachi');
            $table->string('ctphien_sotienchi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ctphienlamviec');
    }
};
