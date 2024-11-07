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
        Schema::create('serti_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('serti_id');
            $table->string('no_urut');
            $table->string('nip');
            $table->string('nama');
            $table->string('qr_code')->nullable();
            $table->string('nomor')->nullable();
            $table->string('nm_file')->nullable();
            $table->integer('sts')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serti_lists');
    }
};
