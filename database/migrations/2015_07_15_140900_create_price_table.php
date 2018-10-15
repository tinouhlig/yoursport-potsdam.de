<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->float('amount');
            $table->integer('duration'); //the duration will be saved in days
            $table->string('duration_type'); // type of duration, weeks, months
            $table->integer('course_count'); // the amount of courses u can take place
            $table->string('status')->default('active');
            $table->string('slug')->unique();
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
        Schema::drop('price');
    }
}
