<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model {

    protected $table = 'clientes';
    protected $primaryKey = 'cli_id';
    public $timestamps = false;
    
    protected $fillable = [
        'cli_nome',
        'cli_apelido',
        'cli_identificacao',
        'cli_inscricao_estadual',
        'cli_inscricao_municipal',
        'cli_endereco_site',
        'cli_nome_contato',
        'cli_observacoes',
        'cli_data_adicionado',
        'cli_tipo_identificacao',
        'cli_codigo_loja',
        'cli_codigo_venda',
    ];
    
    public $rules = [
        'cli_nome'                => 'required',
        'cli_apelido'             => 'required',
        'cli_identificacao'       => 'required',
        'cli_inscricao_estadual'  => 'required',
        'cli_inscricao_municipal' => 'required',
        'cli_endereco_site'       => 'required',
        'cli_nome_contato'        => 'required',
        'cli_observacoes'         => 'required',
    ];
    
    public function endereco()
    {
        return $this->hasOne('App\models\ClienteEndereco','end_idcliente');
    }
    
    public function contatos()
    {
        return $this->hasMany('App\models\ClienteContato','contato_idcliente');
    }
    
    public function addContato($numero, $tipo, $idOperadora = null)
    {
        if(!$numero){
            return false;
        }
        
        $dataContato = [
            'contato_numero'      => $numero,
            'contato_tipo'        => $tipo,
        ];
        
        if($idOperadora){
            $dataContato['contato_idoperadora'] = $idOperadora;
        }
        
        $contato = $this->contatos()->where('contato_tipo',$tipo)->first();
        
        if($contato){
            $contato->update($dataContato);
        } else {
            $this->contatos()->create($dataContato);
        }
        
    }
    
    public function ativos()
    {
       return $this->where('cli_status','ATIVO')
                ->where('cli_id','!=',1)
                ->get();
    }

}

