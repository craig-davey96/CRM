<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskSubTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_sub_tasks', function (Blueprint $table) {
            $table->increments('task_sub_id');
            $table->integer('task_id')->unsigned();
            $table->string('task_sub_title');
            $table->text('task_sub_description');
            $table->integer('task_sub_added_by')->unsigned();
            $table->timestamps();
            $table->foreign('task_sub_added_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('task_id')->references('task_id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_sub_tasks');
    }
}
