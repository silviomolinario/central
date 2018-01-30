<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContatosClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_contatos', function (Blueprint $table){
            $table->increments('contato_id');
            $table->integer('contato_idoperadora')->nullable();
            $table->integer('contato_idcliente');
            $table->enum('contato_tipo',['FIXO','MOVEL','FAX']);
            $table->string('contato_numero');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('cliente_contatos');
    }
}
