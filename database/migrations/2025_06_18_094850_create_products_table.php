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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->uuid('category_id');
            $table->uuid('sub_id')->nullable();
            $table->uuid('brand_id')->nullable();
            $table->text('small_description')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('original_price', 10,2);
            $table->decimal('selling_price',10,2)->nullable();
            $table->integer('stock');
            $table->string('image')->nullable();
            
            $table->boolean('flash_sales')->default(false);
            $table->boolean('best_sell')->default(false);
            $table->boolean('explore')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
            // 
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('sub_id')->references('id')->on('subs')->onDelete('set null');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
