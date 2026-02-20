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
        Schema::create('booklist_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booklist_section_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('vendor_product_id')->nullable(); // optional but useful
            $table->string('display_name', 200)->nullable(); // School-specific name
            $table->integer('qty_required')->default(1);
            $table->boolean('is_optional')->default(false); // 0 required, 1 optional
            $table->decimal('price_override', 10, 2)->nullable(); // Optional school override price
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->foreign('booklist_section_id')->references('id')->on('booklist_sections')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('vendor_product_id')->references('id')->on('vendor_products')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booklist_items');
    }
};