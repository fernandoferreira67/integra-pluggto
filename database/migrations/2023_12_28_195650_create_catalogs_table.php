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
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id();
            $table->string('erp_id')->nullable(); //ID_PRODUTO
            $table->string('sku')->nullable();
            $table->string('product_type')->nullable(); //Simples, KIT ou Variação
            $table->string('product_name')->nullable();
            $table->text('description')->nullable();
            $table->string('categories')->nullable();
            $table->string('warranty')->nullable(); //garantia
            $table->string('product_availability')->nullable(); //prazo disponibilidade
            $table->string('brand')->nullable(); //marca
            $table->string('gtin_ean')->nullable();
            $table->string('unit')->nullable();
            $table->string('ncm')->nullable();
            $table->string('tax_origin')->nullable(); //origem tributaria
            $table->decimal('price_cost', $precision = 8, $scale = 2);
            $table->decimal('price_sale', $precision = 8, $scale = 2);
            $table->char('active', 1);
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('weight')->nullable(); //peso
            $table->string('height')->nullable(); //altura
            $table->string('width')->nullable(); //largura
            $table->string('length')->nullable(); //comprimento
            $table->foreignId('supplier_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogs');
    }
};
