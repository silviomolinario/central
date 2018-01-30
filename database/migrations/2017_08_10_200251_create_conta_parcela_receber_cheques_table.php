<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContaParcelaReceberChequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas_parcelas_receber_cheques', function (Blueprint $table) {
            $table->increments('relacao_id');
            $table->integer('relacao_idcheque');
            $table->integer('relacao_idparcela');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contas_parcelas_receber_cheques');
    }
}
