<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 80);
            $table->string('email', 80);
            $table->string('telefone', 15)->nullable(true);
            $table->string('cep', 10);
            $table->string('logradouro', 100);
            $table->integer('numero', false);
            $table->string('complemento', 50)->nullable(true);
            $table->string('bairro', 80);
            $table->string('cidade', 80);
            $table->string('estado', 22);
            $table->dateTime('dt_criacao');
            $table->dateTime('dt_atualizacao')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
