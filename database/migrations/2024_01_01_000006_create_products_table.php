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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code', 40); // ISBN or unique product code
            $table->string('name', 200);
            $table->string('type', 20); // book/stationery/other
            $table->string('brand', 120)->nullable(); // Brand/publisher
            $table->string('uom', 20)->nullable(); // Unit of measure (e.g., unit, pack)
            $table->string('status', 20)->default('active'); // active/inactive
            $table->timestamps();

            $table->unique('code');
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