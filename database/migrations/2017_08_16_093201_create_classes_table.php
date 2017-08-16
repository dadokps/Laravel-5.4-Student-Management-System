<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('class_id');
            $table->integer('academic_id')->unsigned();
            $table->integer('level_id')->unsigned();
            $table->integer('shift_id')->unsigned();
            $table->integer('time_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->integer('batch_id')->unsigned();
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('active');
            $table->foreign('academic_id')->references('academic_id')->on('academics');
            $table->foreign('level_id')->references('level_id')->on('levels');
            $table->foreign('shift_id')->references('shift_id')->on('shifts');
            $table->foreign('time_id')->references('time_id')->on('times');
            $table->foreign('group_id')->references('group_id')->on('groups');
            $table->foreign('batch_id')->references('batch_id')->on('batches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
