<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosPermissoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_tipos_permissoes', function (Blueprint $table) {
            $table->increments('perm_id');
            $table->integer('perm_idtipo')->unsigned();
            $table->integer('perm_idpermissao')->unsigned();
            
            $table->foreign('perm_idtipo')->references('tip_id')->on('usuarios_tipos');
            $table->foreign('perm_idpermissao')->references('perm_id')->on('permissoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_tipos_permissoes');
    }
}
