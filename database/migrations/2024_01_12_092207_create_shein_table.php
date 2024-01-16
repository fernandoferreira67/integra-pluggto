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
        Schema::create('shein', function (Blueprint $table) {
          $table->id();
          $table->string('pluggto_sku')->nullable();
          $table->string('pluggto_parent_sku')->nullable();
          $table->string('marketplace_sku')->nullable();
          $table->string('marketplace_parent_sku')->nullable();
          $table->string('channel_store')->nullable();
          $table->string('sync')->nullable();
          $table->string('status')->nullable();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shein');
    }
};
