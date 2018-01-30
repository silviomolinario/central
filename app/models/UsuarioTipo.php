<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UsuarioTipo extends Model
{
    protected $table = 'usuarios_tipos';
    protected $primaryKey = 'tip_id';
    public $timestamps = false;
    
    public function hasPermissao($idPermissao)
    {
        return $this->tipo->where('perm_idpermissao',$idPermissao)->first();
    }
    
    public function tipo()
    {
        return $this->hasMany('App\models\UsuarioTipoPermissao','perm_idtipo');
    }
}
