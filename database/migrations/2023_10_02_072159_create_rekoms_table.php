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
        Schema::create('rekoms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rencana_id')->default(0);
            $table->foreignId('asn_id');
            $table->foreignId('diklat_id');
            $table->string('bentuk');
            $table->string('jalur');
            $table->string('jenis');
            $table->string('tempat');
            $table->string('pelaksana');
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
        Schema::dropIfExists('rekoms');
    }
};
