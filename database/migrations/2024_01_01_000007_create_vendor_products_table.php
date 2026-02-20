<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendor_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('product_id');
            $table->string('sku', 60)->nullable(); // Optional vendor SKU
            $table->decimal('default_price', 10, 2);
            $table->integer('stock_qty')->default(0);
            $table->integer('min_stock_qty')->nullable(); // Optional reorder threshold
            $table->string('status', 20)->default('active'); // active/inactive
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_products');
    }
};