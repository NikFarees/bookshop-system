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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('provider', 30); // fpx
            $table->string('provider_ref', 120)->nullable(); // Gateway reference
            $table->string('status', 20)->default('init'); // init/paid/failed/refunded
            $table->decimal('amount', 10, 2);
            $table->datetime('paid_at')->nullable();
            $table->json('raw_response')->nullable(); // Gateway payload snapshot
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};