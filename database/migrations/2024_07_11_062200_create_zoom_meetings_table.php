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
        Schema::create('zoom_meetings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id');
            $table->string('meeting_id')->unique();
            $table->string('topic');
            $table->string('start_time');
            $table->integer('duration');
            $table->string('timezone');
            $table->string('join_url');
            $table->string('host_id');
            $table->string('password')->nullable();
            $table->text('agenda')->nullable();
            $table->text('participants');
            $table->string('is_viewed');
            $table->foreign('appointment_id')->references('id')->on('appointments_models')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zoom_meetings');
    }
};
