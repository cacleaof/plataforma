<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consults', function (Blueprint $table) {
            $table->timestamps();
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('serviço', 50)->nullable();
            $table->text('consulta');
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
            $table->date('tempo')->nullable();
            $table->string('solicitaçao', 50)->nullable();
            $table->boolean('ativo')->nullable();
            $table->string('paciente', 50)->nullable();
            $table->string('idade')->nullable();
            $table->string('queixa')->nullable();
            $table->string('instituiçao')->nullable();
            $table->string('municipio_sol', 50)->nullable();
            $table->string('area', 50)->nullable();
            $table->string('ibge_sol', 7)->nullable();
            $table->boolean('anexos')->nullable();
            $table->text('devolutiva')->nullable();
            $table->text('dev_reg')->nullable();
            $table->text('resposta')->nullable();
            $table->text('l_recom')->nullable();
            $table->string('ciap', 50)->nullable();
            $table->string('dec1', 50)->nullable();
            $table->string('dec2', 50)->nullable();
            $table->string('dec3', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consults');
    }
}
