<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Nachholkurse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nachholkurse', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->date('gueltig_bis');
            $table->integer('signedInCoursedate')->unsigned()->nullable();
            $table->integer('signedOutCoursedate')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('signedInCoursedate')
                  ->references('id')
                  ->on('coursedate')
                  ->onDelete('cascade');
            $table->foreign('signedOutCoursedate')
                  ->references('id')
                  ->on('coursedate')
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
        //
    }
}
