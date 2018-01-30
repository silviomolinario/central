<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class Produto extends Model {

    protected $table = 'produtos';
    protected $primaryKey = 'pro_id';
    public $timestamps = false;
    
    protected $fillable = [
        'pro_nome',
        'pro_idcategoria',
        'pro_codigo_principal',
        'pro_codigo_secundario',
        'pro_codigo_fabricante',
        'pro_codigo_barra',
        'pro_nome',
        'pro_descricao',
        'pro_cfop',
        'pro_prateleira',
        'pro_codigo_prateleira',
        'pro_status',
        'pro_preco',
        'pro_data_adicionada',
        'pro_medida'
    ];
    
    public function rules()
    {
        return [
            'pro_nome'              => 'required',
            'pro_idcategoria'       => 'required',
            'pro_codigo_fabricante' => 'required',
            'pro_cfop'              => 'required',
            'pro_prateleira'        => 'required',
            'pro_preco'             => 'required',
            'pro_medida'            => 'required',
        ];
    }

    public function categoria() {

        return $this->hasOne('App\models\Categoria', 'cat_id', 'pro_idcategoria');
    }
    
    public function estoques() {
        
        return $this->hasMany('App\models\Estoque','esto_idproduto');
    }
    
    public function estoqueLoja($idproduto = false)
     {
        if (!$idproduto){
            $idproduto = $this->pro_id;
        }
        
         $produto = DB::table('produtos_estoques')
                 ->select([
                    DB::raw('COALESCE(SUM(esto_quantidade),0) AS quantidade')
                 ])
                 ->where('esto_local','LOJA')
                 ->where('esto_idproduto',$idproduto)
                 ->first();
                 
         return $produto->quantidade;
    }

    public function estoquePrateleira($idproduto = false) 
    {
        
        if (!$idproduto){
            $idproduto = $this->pro_id;
        }
        
         $produto = DB::table('produtos_estoques')
                 ->select([
                    DB::raw('COALESCE(SUM(esto_quantidade),0) AS quantidade')
                 ])
                 ->where('esto_local','PRATELEIRA')
                 ->where('esto_idproduto',$idproduto)
                 ->first();
                 
         return $produto->quantidade;
    }
    
    public function derivados()
    {
        if($this->pro_codigo_principal == $this->pro_codigo_secundario){
           return Produto::where('pro_codigo_secundario',$this->pro_codigo_secundario)
                   ->where('pro_id', '!=', $this->pro_id)
                   ->get();
        }
        
        return null;
    }
    
    public function derivante()
    {

        if($this->pro_codigo_principal != $this->pro_codigo_secundario){
           return Produto::where('pro_codigo_principal',$this->pro_codigo_secundario)->first();
        }
        
        return null;
    }

}
