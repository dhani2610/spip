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
        Schema::create('spips', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('merek');
            $table->string('jenis_unit');
            $table->string('perusahaan');
            $table->string('nomor_unit');
            $table->string('commisioner');
            $table->date('tanggal_commisioning')->nullable();
            $table->text('deviasi')->nullable();
            $table->integer('user');
            $table->string('sticker')->nullable();
            $table->string('status');
            $table->date('tanggal_expired')->nullable();
            $table->string('upload_foto')->nullable();
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spips');
    }
};
