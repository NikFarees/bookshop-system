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
        Schema::create('import_rows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('import_id');
            $table->integer('row_no');
            $table->json('row_json'); // Extracted data
            $table->unsignedBigInteger('matched_product_id')->nullable();
            $table->unsignedBigInteger('matched_vendor_product_id')->nullable();
            $table->string('status', 30)->default('pending'); // pending/confirmed/rejected
            $table->timestamps();

            $table->foreign('import_id')->references('id')->on('imports')->onDelete('cascade');
            $table->foreign('matched_product_id')->references('id')->on('products')->onDelete('set null');
            $table->foreign('matched_vendor_product_id')->references('id')->on('vendor_products')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_rows');
    }
};