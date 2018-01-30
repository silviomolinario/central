<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UsuarioTipoPermissao extends Model
{
    protected $table = 'usuarios_tipos_permissoes';
    protected $primaryKey = 'perm_id';
    public $timestamps = false;
    
    protected $fillable = [
        'perm_idtipo',
        'perm_idpermissao'
    ];
}
