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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->date('tanggal');
            $table->string('order_id_midtrans');
            $table->integer('paket_id');
            $table->integer('durasi');
            $table->date('dari_tanggal');
            $table->date('sampai_tanggal');
            $table->string('total_harga');
            $table->string('nama');
            $table->string('type'); // month or week 
            $table->string('harga'); // idr
            $table->json('benefit'); // listing benefit 
            $table->json('group'); // month or week 
            $table->integer('include_asset'); // 1 or 0 
            $table->json('asset')->nullable(); // month or week 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
