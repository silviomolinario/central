<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('clientes', function (Blueprint $table){
            $table->increments('cli_id');
            $table->string('cli_codigo_central')->nullable();
            $table->string('cli_codigo_loja')->nullable();
            $table->integer('cli_codigo_venda')->nullable();
            $table->string('cli_nome');
            $table->string('cli_apelido')->nullable();
            $table->string('cli_identificacao');
            $table->enum('cli_tipo_identificacao',['FISICA','JURIDICA']);
            $table->string('cli_inscricao_estadual')->nullable();
            $table->string('cli_inscricao_municipal')->nullable();
            $table->string('cli_nome_contato')->nullable();
            $table->string('cli_endereco_site')->nullable();
            $table->string('cli_observacoes')->nullable();
            $table->enum('cli_status',['ATIVO','INATIVO','EXCLUIDO'])->default('ATIVO');
            $table->datetime('cli_data_adicionado');
            $table->datetime('cli_data_atualizada')->nullable();
            $table->datetime('cli_data_excluida')->nullable();
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
