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
            $table->string('title');
            $table->text('description')->nullable();;
            $table->unsignedBigInteger('assignee_id')->nullable();;
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->unsignedInteger('progress');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('task_parent_id')->nullable();;
            $table->softDeletes();
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
        Schema::dropIfExists('tasks');
    }
}
