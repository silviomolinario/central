<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('cat_id');
            $table->string('cat_nome');
            $table->integer('cat_status')->default('1');
            $table->datetime('cat_data_adicionado');
            $table->datetime('cat_data_atualizada')->nullable();
            $table->datetime('cat_data_excluida')->nullable();
         
         });
    }

   
    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}
