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
        Schema::create('rekom_sesuais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rencana_id');
            $table->string('pelaksana');
            $table->string('tempat');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekom_sesuais');
    }
};
