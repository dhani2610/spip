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
        Schema::create('pakets', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('type'); // month or week 
            $table->string('harga'); // idr
            $table->json('benefit'); // listing benefit 
            $table->json('group'); // month or week 
            $table->integer('include_asset'); // 1 or 0 
            $table->json('asset')->nullable(); // month or week 
            $table->integer('status');
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};
