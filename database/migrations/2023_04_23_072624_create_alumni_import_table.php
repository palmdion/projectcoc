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
        Schema::create('alumni_import', function (Blueprint $table) {
            $table->id();
            $table->string('student_code')->nullable();
            $table->string('student_name_th')->nullable();
            $table->string('student_surname_th')->nullable();
            $table->string('student_name_en')->nullable();
            $table->string('student_surname_en')->nullable();
            $table->string('program_name')->nullable();
            $table->string('faculty_name')->nullable();
            $table->string('admit_year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_import');
    }
};
