<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaixasMensagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensagens', function (Blueprint $table){
            $table->increments('men_id');
            $table->integer('men_idloja');
            $table->text('men_descricao');
            $table->text('men_titulo');
            $table->enum('men_status',["ATIVO","EXCLUIDO"])->default('ATIVO');
            $table->datetime('men_data_adicionado');
            $table->datetime('men_data_excluida')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('mensagens');
    }
}
