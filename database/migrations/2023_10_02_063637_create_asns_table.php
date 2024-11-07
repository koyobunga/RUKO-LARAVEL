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
        Schema::create('asns', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip')->unique();
            $table->foreignId('opd_id')->nullable();
            $table->foreignId('keljab_id')->nullable();
            $table->string('email')->nullable();
            $table->string('foto')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('golongan')->nullable();
            $table->text('device_id')->nullable();
            $table->text('token_notif')->nullable();
            $table->foreignId('upt_id')->default(0);
            $table->string('kelasn')->default('NON ASN');
            $table->integer('sts')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asns');
    }
};
