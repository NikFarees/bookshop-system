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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no', 40); // Human-friendly order number
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('booklist_id');
            $table->integer('academic_year')->nullable(); // Snapshot
            $table->string('grade_label', 60)->nullable(); // Snapshot
            $table->string('fulfillment_method', 20)->default('pickup'); // pickup/shipment
            $table->string('status', 30)->default('draft'); // draft/pending_payment/paid/processing/ready/picked_up/shipped/completed/cancelled
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('shipping_fee', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->string('customer_name', 150)->nullable(); // Snapshot contact
            $table->string('customer_phone', 30)->nullable(); // Snapshot contact
            $table->string('customer_email', 190)->nullable(); // Snapshot contact
            $table->text('remarks')->nullable(); // Parent remarks
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('parents')->onDelete('cascade');
            $table->foreign('school_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('booklist_id')->references('id')->on('booklists')->onDelete('cascade');

            $table->unique('order_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};