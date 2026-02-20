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
        Schema::create('imports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id')->nullable(); // School/admin org (optional)
            $table->unsignedBigInteger('user_id');
            $table->string('type', 30); // excel_booklist/pdf_booklist
            $table->string('file_name', 255);
            $table->string('status', 30)->default('uploaded'); // uploaded/extracted/mapped/imported/failed
            $table->text('notes')->nullable(); // Error/log summary
            $table->timestamps();

            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imports');
    }
};