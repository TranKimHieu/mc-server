<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyFinishToStartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('finish_to_start', function (Blueprint $table) {
            $table->foreign('finish_task_id')->references('id')->on('tasks');
            $table->foreign('start_task_id')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('start', function (Blueprint $table) {
            //
        });
    }
}
