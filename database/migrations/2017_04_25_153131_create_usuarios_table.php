<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
  
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table){
            $table->increments('usu_id');
            $table->integer('usu_idpermissao');
            $table->string('usu_usuario');
            $table->string('usu_senha');
            $table->string('usu_nome');
            $table->string('usu_email');
            $table->enum('usu_status',['ATIVO','BLOQUIADO','EXCLUIDO'])->default('ATIVO');
            $table->datetime('usu_data_acesso')->nullable();
            $table->datetime('usu_data_adicionada');
            $table->datetime('usu_data_excluido')->nullable();
            $table->datetime('usu_data_bloqueado')->nullable();
            $table->string('remember_token',100)->nullable();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
