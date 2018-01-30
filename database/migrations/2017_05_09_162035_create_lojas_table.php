<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLojasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lojas', function (Blueprint $table){
            $table->increments('loj_id');
            $table->string('loj_codigo_interno');
            $table->string('loj_nome');
            $table->string('loj_cnpj');
            $table->string('loj_urlapi')->nullable();
            $table->string('loj_inscricao_estadual')->nullable();
            $table->string('loj_telefone');
            $table->string('loj_email');
            $table->string('loj_endereco');
            $table->string('loj_endereco_numero');
            $table->string('loj_bairro');
            $table->string('loj_cidade');
            $table->integer('loj_idestado');
            $table->string('loj_logo')->nullable();
            $table->integer('loj_slave_ativo')->default(0);
            $table->enum('loj_status',["PENDENTE","ATIVO","EXCLUIDO"])->default('PENDENTE');
            $table->datetime('loj_data_adicionado');
            $table->datetime('loj_data_excluida')->nullable();
            $table->datetime('loj_data_atualizado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lojas');
    }
}
