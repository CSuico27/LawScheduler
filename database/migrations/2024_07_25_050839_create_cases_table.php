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
            $table->foreignId('petitioner_id')->constrained('users')->cascadeOnDelete();
            $table->string('respondents');
            $table->string('case_no');
            $table->string('case_type');
            $table->string('case_sub_type');
            $table->string('case_stage');
            $table->string('priority_level');
            $table->string('act');
            $table->string('filing_number');
            $table->date('filing_date');
            $table->string('registration_number');
            $table->date('registration_date');
            $table->date('first_hearing_date');
            $table->string('cnr_number');
            $table->string('description')->nullable();
            $table->string('police_station');
            $table->string('fir_number');
            $table->date('fir_date');
            $table->string('court_number');
            $table->string('court_type');
            $table->string('court');
            $table->string('judge_type');
            $table->string('judge_name');
            $table->string('remarks')->nullable();
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
