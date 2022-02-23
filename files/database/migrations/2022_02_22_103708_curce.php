<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Curce extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('vahed');
            $table->unsignedBigInteger("branch");
            $table->foreign('branch')->references('id')->on('branches');
            $table->unsignedBigInteger("categories");
            $table->foreign('categories')->references('id')->on('course_categories');


            $table->unsignedBigInteger("pish1")->nullable();
            $table->foreign('pish1')->references('id')->on('courses');

            $table->unsignedBigInteger("pish2")->nullable();
            $table->foreign('pish2')->references('id')->on('courses');

            $table->Integer("min-vahed")->default(0);

            $table->unsignedBigInteger("ham")->nullable();
            $table->foreign('ham')->references('id')->on('courses');

            $table->unsignedBigInteger("disAllowWith")->nullable();
            $table->foreign('disAllowWith')->references('id')->on('courses');


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
        //
    }
}
