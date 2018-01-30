<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Usuario extends Model {

    protected $table = 'usuarios';
    protected $primaryKey = 'usu_id';
    public $timestamps = false;
    
    public function rules()
    {
        return [
            'usu_nome'        => 'required',
            'usu_usuario'     => ['required',Rule::unique('usuarios')->ignore($this->usu_id, 'usu_id')],
            'usu_senha'       => 'required',
            'usu_email'       => 'required',
            'usu_idpermissao' => 'required',
        ];
    }

    public function tipo() {

        return $this->belongsTo('App\models\UsuarioTipo', 'usu_idpermissao');
    }

}
