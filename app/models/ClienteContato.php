<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ClienteContato extends Model {

    protected $table = 'cliente_contatos';
    protected $primaryKey = 'contato_id';
    public $timestamps = false;
    protected $fillable = [
        'contato_numero',
        'contato_idoperadora',
        'contato_idcliente',
        'contato_tipo',
    ];
    public $rules = [
        'contato.FIXO'       => 'required',
        'contato.MOVEL'      => 'required',
        'contato_idoperadora' => 'required',
    ];

    public function contatoCliente(){
        
        return $this->belongsTo('App\models\Cliente', 'contato_idcliente', ' cli_id');
        
    }
}
