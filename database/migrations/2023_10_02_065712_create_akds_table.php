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
        Schema::create('akds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asn_id');
            $table->foreignId('keljab_id');
            $table->foreignId('kategori_id');
            $table->foreignId('isian_id');
            $table->integer('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akds');
    }
};
