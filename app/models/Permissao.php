<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    protected $table = 'permissoes';
    protected $primaryKey = 'perm_id';
    public $timestamps = false;
    
    protected $fillable = [
        'perm_action',
        'perm_descricao',
        'perm_idgrupo'
    ];
}
