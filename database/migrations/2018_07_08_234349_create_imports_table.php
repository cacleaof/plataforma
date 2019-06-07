<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('cpf')->unique();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('cns', 25)->nullable();
            $table->string('nacionalidade', 255);
            $table->date('data_nascimento', 10);
            $table->string('sexo', 10);
            $table->string('telefone_residencial', 30)->nullable();
            $table->string('telefone_celular', 30);
            $table->string('conselho', 255)->nullable();
            $table->string('num_conselho', 30)->nullable();
            $table->string('razao_social', 255);
            $table->string('nome_fantasia', 255)->nullable();
            $table->string('cnes', 25);
            $table->string('cnpj', 25)->nullable();
            $table->string('cep', 10);
            $table->string('logradouro', 255);
            $table->string('uf', 2);
            $table->string('cidade', 60);
            $table->string('cbo_codigo', 15);
            $table->string('especialidade', 255);
            $table->string('ocupacao', 255);
            $table->string('nome_cargo', 255);
            $table->string('ine', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imports');
    }
}
