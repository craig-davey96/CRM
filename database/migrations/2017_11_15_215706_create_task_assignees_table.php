<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskAssigneesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_assignees', function (Blueprint $table) {
            $table->increments('task_assignee_id');
            $table->integer('task_assignee_task')->unsigned();
            $table->integer('task_assignee_link_id')->unsigned();
            $table->timestamps();
            $table->foreign('task_assignee_task')->references('task_id')->on('tasks')->onDelete('cascade');
            $table->foreign('task_assignee_link_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_assignees');
    }
}
