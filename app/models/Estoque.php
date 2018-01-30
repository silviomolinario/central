<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $table = 'produtos_estoques';
    protected $primaryKey = 'esto_id';
    public $timestamps = false;
    protected $fillable = [
        'esto_status',
        'esto_idproduto',
        'esto_quantidade',
        'esto_idloja',
        'esto_local',
        'esto_data_adicionado'
    ];

    public function produto() {
        
         return $this->hasOne('App\models\Produto', 'pro_id','esto_idproduto');
    }
    
    public function addEstoqueLoja($idProduto,$valor) {
        
        $this->create([
                  'esto_status' => 'ATIVO',
                  'esto_idproduto' => $idProduto,
                  'esto_quantidade' => $valor,
                  'esto_idloja' => 1,
                  'esto_local' => 'LOJA',
                  'esto_data_adicionado' => date('Y-m-d H:i:s'), 
               ]);
    }
    
    public function addEstoquePrateleira($idProduto,$valor) {
        
        $this->create([
                  'esto_status' => 'ATIVO',
                  'esto_idproduto' => $idProduto,
                  'esto_quantidade' => $valor,
                  'esto_idloja' => 1,
                  'esto_local' => 'PRATELEIRA',
                  'esto_data_adicionado' => date('Y-m-d H:i:s'), 
               ]);
    }
}