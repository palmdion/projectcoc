<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnis', function (Blueprint $table) {
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
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumni');
    }
};
