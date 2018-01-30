<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PermissaoGrupo extends Model
{
    protected $table = 'permissoes_grupos';
    protected $primaryKey = 'gru_id';
    public $timestamps = false;
    
    protected $fillable = [
        'gru_id',
        'gru_nome'
    ];
    
    public function permissoes()
    {
        return $this->hasMany('App\models\Permissao','perm_idgrupo')
                ->where('perm_idgrupo', $this->gru_id)
                ->get();
    }
}
