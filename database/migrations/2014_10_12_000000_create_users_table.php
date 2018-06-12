<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            //$table->date('data_nasc')->nullable();
            //$table->string('sexo')->nullable();
            //$table->string('fone')->nullable();
            //$table->string('Municipio')->nullable();
            $table->string('cpf', 11)->unique();
            //$table->string('cns', 7)->unique()->nullable();
            //$table->string('cbo', 6)->nullable();
            //$table->string('ine', 10)->nullable();
            //$table->string('tprof', 2)->nullable();
            $table->string('email')->unique();
            //$table->string('email_alter')->nullable();
            $table->string('image', 100)->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
