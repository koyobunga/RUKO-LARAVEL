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
        Schema::create('pelaksanaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asn_id');
            $table->foreignId('rencana_id')->default(0);
            $table->foreignId('diklat_id')->default(0);
            $table->text('ket')->nullable();
            $table->string('pelaksana');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->string('tempat')->nullable();
            $table->string('bentuk');
            $table->integer('jp');
            $table->string('no_serti');
            $table->string('nm_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaksanaans');
    }
};
