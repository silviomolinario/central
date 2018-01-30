<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cheques', function (Blueprint $table){
            $table->increments('che_id');
            $table->integer('che_loja');
            $table->integer('che_cliente_repassado')->nullable();
            $table->integer('che_idbanco');
            $table->integer('che_comp');
            $table->string('che_agencia');
            $table->string('che_conta');
            $table->string('che_numero_cheque');
            $table->string('che_emitente');
            $table->string('che_cnpj_cpf');
            $table->string('che_telefone');
            $table->datetime('che_data_emissao');
            $table->datetime('che_data_vencimento');
            $table->decimal('che_valor',10,2);
            $table->text('che_observacao')->nullable();
            $table->enum('che_status',['AGUARDANDO','REPASSADO','DEVOLVIDO','RECEBIDO','EXCLUIDO'])->default('AGUARDANDO');
            $table->datetime('che_data_adicionado');
            $table->datetime('che_data_atualizada')->nullable();
            $table->datetime('che_data_excluida')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cheques');
    }
}
