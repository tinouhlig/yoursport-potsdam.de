<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // coursedate belongs to course, course has many coursedates
        Schema::table('coursedate', function (Blueprint $table) {
            $table->integer('course_id')->unsigned();

            $table->foreign('course_id')
                  ->references('id')
                  ->on('course')
                  ->onDelete('cascade');
        });

        // course belongs to coursetype, coursetype has many course
        Schema::table('course', function (Blueprint $table) {
            $table->integer('coursetype_id')->unsigned();

            $table->foreign('coursetype_id')
                  ->references('id')
                  ->on('coursetype')
                  ->onDelete('cascade');
        });

        // coursetype has many prices, price has many coursetypes
        Schema::create('coursetype_price', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coursetype_id')->unsigned();
            $table->integer('price_id')->unsigned();
            $table->timestamps();

            $table->foreign('coursetype_id')
                  ->references('id')
                  ->on('coursetype')
                  ->onDelete('cascade');
            $table->foreign('price_id')
                  ->references('id')
                  ->on('price')
                  ->onDelete('cascade');
        });

        // coursedate has many users, user has many coursedates
        Schema::create('coursedate_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coursedate_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('status')->default('normal');
            $table->timestamps();

            $table->foreign('coursedate_id')
                  ->references('id')
                  ->on('coursedate')
                  ->onDelete('cascade');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });

        // coursedate has many users, user has many coursedates
        Schema::create('price_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('booked_at');
            $table->date('expire_at');
            $table->boolean('cancelled')->default(0);
            $table->timestamps();

            $table->foreign('price_id')
                  ->references('id')
                  ->on('price')
                  ->onDelete('cascade');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });

        // course has many users, user has many course
        Schema::create('course_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->integer('price_user_id')->unsigned();
            $table->timestamps();

            $table->foreign('course_id')
                  ->references('id')
                  ->on('course')
                  ->onDelete('cascade');
            $table->foreign('users_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('price_user_id')
                  ->references('id')
                  ->on('price_user')
                  ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coursedate', function (Blueprint $table) {
            $table->dropForeign('coursedate_course_id_foreign');
        });
        Schema::table('course', function (Blueprint $table) {
            $table->dropForeign('course_coursetype_id_foreign');
        });
        Schema::drop('course_users');
        Schema::drop('coursetype_price');
        Schema::drop('coursedate_users');
    }
}
