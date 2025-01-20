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
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->date('date_received');
            $table->string('time_received');
            $table->string('receiving_staff');
            $table->string('nps_docket_no');
            $table->string('assign_to');
            $table->date('date_assigned');
            $table->string('case_stage');
            $table->string('priority_level');

            $table->string('complainants');
            $table->string('respondents');
            $table->string('laws_violated');
            $table->string('witnesses');

            $table->string('date_time_commission');
            $table->string('place_of_commission');

            $table->boolean('question_one')->default(false);
            $table->boolean('question_two')->default(false);
            $table->boolean('question_three')->default(false);

            $table->string('is_no');
            $table->string('handling_prosecutor');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};
