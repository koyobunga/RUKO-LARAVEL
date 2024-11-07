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
        Schema::create('sertis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diklat_id');
            $table->foreignId('opd_id');
            $table->integer('jp');
            $table->string('label_bentuk');
            $table->string('label_diklat');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->string('ttd_oleh');
            $table->string('ttd_nama');
            $table->string('ttd_nip');
            $table->string('ttd_pangkat');
            $table->string('nomor');
            $table->string('bentuk');
            $table->string('tempat')->nullable();
            $table->integer('sts')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertis');
    }
};
