<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_enderecos', function (Blueprint $table){
            $table->increments('end_id');
            $table->integer('end_iduf');
            $table->integer('end_idcliente');
            $table->string('end_numero');
            $table->string('end_endereco');
            $table->string('end_complemento')->nullable();
            $table->string('end_bairro');
            $table->string('end_cidade');
            $table->string('end_cep');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente_enderecos');
    }
}
