<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('serviço', 50)->nullable();
            $table->text('descriçao');
            $table->string('convenio', 20)->nullable();
            $table->string('municipio', 50)->nullable();
            $table->string('ibge', 7)->nullable();
            $table->string('UF', 2)->nullable();
            $table->string('status', 1);
            $table->string('sol_name', 50)->nullable();
            $table->string('reg_name', 50)->nullable();
            $table->integer('reg_id')->nullable();
            $table->string('cons_name', 50)->nullable();
            $table->integer('cons_id')->nullable();
            $table->timestamps();
            $table->date('tempo')->nullable();
            $table->string('solicitaçao', 50)->nullable();
            $table->boolean('ativo')->nullable();
            $table->string('paciente', 50)->nullable();
            $table->string('municipio_sol', 50)->nullable();
            $table->string('ibge_sol', 7)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
