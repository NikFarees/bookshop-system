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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('actor_user_id');
            $table->string('action', 80); // e.g., APPROVE_SCHOOL, PUBLISH_BOOKLIST
            $table->string('entity_type', 80); // Table/model name
            $table->unsignedBigInteger('entity_id'); // Target record id
            $table->json('before_json')->nullable(); // Before values
            $table->json('after_json')->nullable(); // After values
            $table->datetime('created_at');

            $table->foreign('actor_user_id')->references('id')->on('users')->onDelete('cascade');

            // Index for performance
            $table->index(['entity_type', 'entity_id']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};