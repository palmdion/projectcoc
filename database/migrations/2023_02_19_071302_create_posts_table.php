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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('post_title');
            $table->text('description');
            $table->string('post_image')->nullable();
            $table->tinyInteger('is_approved')->comment('1=Approved,0=Pending')->default(0);
            $table->tinyInteger('status')->comment('0=Within,1=Public,2=Slider ')->default(0);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('cate_name');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('category_post', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        // Schema::create('tags', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('tag_name');
        //     $table->text('description');
        //     $table->timestamps();
        // });

        // Schema::create('post_tag', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('post_id');
        //     $table->unsignedBigInteger('tag_id');
        //     $table->timestamps();

        //     $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        //     $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('category_post');
        // Schema::dropIfExists('tags');
        // Schema::dropIfExists('post_tag');
    }
};
