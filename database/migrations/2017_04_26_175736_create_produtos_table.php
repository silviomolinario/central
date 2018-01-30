<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('pro_id');
            $table->integer('pro_idcategoria');
            $table->string('pro_codigo_principal');
            $table->string('pro_codigo_secundario')->nullable();
            $table->string('pro_codigo_fabricante');
            $table->string('pro_codigo_barra')->nullable();
            $table->string('pro_nome');
            $table->string('pro_descricao')->nullable();
            $table->string('pro_cfop')->nullable();
            $table->enum('pro_medida',['QUILO','METRO','UNIDADE'])->default('UNIDADE');
            $table->enum('pro_prateleira',['SIM','NAO'])->default('NAO');
            $table->string('pro_codigo_prateleira')->nullable();
            $table->enum('pro_status',['ATIVO','INATIVO','EXCLUIDO'])->default('ATIVO');
            $table->decimal('pro_preco',10,2);
            $table->datetime('pro_data_adicionada');
            $table->datetime('pro_data_excluido')->nullable();
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
