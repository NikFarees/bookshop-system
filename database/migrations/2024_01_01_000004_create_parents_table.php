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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('phone', 30)->nullable();
            $table->string('default_address_line1', 255)->nullable();
            $table->string('default_address_line2', 255)->nullable();
            $table->string('default_city', 100)->nullable();
            $table->string('default_state', 100)->nullable();
            $table->string('default_postcode', 20)->nullable();
            $table->string('default_country', 80)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents');
    }
};