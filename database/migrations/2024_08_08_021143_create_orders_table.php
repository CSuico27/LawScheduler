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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_detail_id');
            $table->string('services_ids');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->decimal('grand_total', 10, 2);
            $table->enum('status', ['Unclaimed', 'Claimed'])->default('Unclaimed');
            $table->timestamps();

            $table->foreign('appointment_detail_id')
                ->references('id')
                ->on('appointment_details')
                ->onDelete('cascade');
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
