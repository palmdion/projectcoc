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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('degree_fullName')->comment('ชื่อย่อระดับการศึกษา');
            $table->string('degree_shortName')->comment('ชื่อย่อระดับการศึกษา');
            $table->string('depart_fullName')->comment('ชื่อเต็มหลักสูตร');
            $table->string('depart_shortName')->comment('ชื่อย่อหลักสูตร');
            $table->string('degreeName_full')->comment('ชื่อเต็มปริญญา');
            $table->string('degreeName_short')->comment('ชื่อย่อปริญญา');
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
        Schema::dropIfExists('departments');
    }
};
