<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ClienteEndereco extends Model {

    protected $table = 'cliente_enderecos';
    protected $primaryKey = 'end_id';
    public $timestamps = false;
    
    protected $fillable = [
        'end_endereco',
        'end_numero',
        'end_complemento',
        'end_bairro',
        'end_cep',
        'end_iduf',
        'end_cidade',
    ];
    
    public $rules = [
        'end_endereco'    => 'required',
        'end_numero'      => 'required',
        'end_complemento' => 'required',
        'end_bairro'      => 'required',
        'end_cep'         => 'required',
        'end_cidade'      => 'required',
        'end_iduf'        => 'required',
    ];

    public function enderecoCliente(){
        
         return $this->belongsTo('App\models\Cliente','end_idcliente');
    }
}
