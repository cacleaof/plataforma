<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('text');
            $table->string('detalhe')->nullable();
            $table->integer('status')->nullable();
            $table->date('start_date')->nullable();
            $table->date('date_fim')->nullable();
            $table->integer('duration')->nullable();
            $table->float('progress')->nullable();
            $table->integer('parent')->nullable();
            $table->integer('urg')->nullable();
            $table->integer('imp')->nullable();
            $table->timestamps();
            $table->integer('user_id')->nullable();
            $table->integer('proj_id')->nullable();
            $table->integer('sortorder')->nullable()->default(0);
            //$table->foreign('proj_id')->references('id')->on('projects')->onDelete('cascade');
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
