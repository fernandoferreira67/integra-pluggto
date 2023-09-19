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
        Schema::create('olist', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->nullable();
            $table->string('sku')->nullable();
            $table->string('sku_erp')->nullable();
            $table->string('store')->nullable();
            $table->string('sync')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('olist');
    }
};
