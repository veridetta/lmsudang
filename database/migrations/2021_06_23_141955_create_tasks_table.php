<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('attendance_id')->references('id')->on('attendance');
            $table->string('academic_id')->references('id')->on('academic');
            $table->string('student_id')->references('id')->on('student');
            $table->string('schedule_id')->references('id')->on('schedule');
            $table->string('title');
            $table->longText('content');
            $table->string('file_name');
            $table->string('path');
            $table->DateTime('submit')->default(\Carbon\Carbon::now());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
