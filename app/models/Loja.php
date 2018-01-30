<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class Loja extends Model
{
    protected $table = 'lojas';
    protected $primaryKey = 'loj_id';
    public $timestamps = false;
    protected $fillable = [
        'loj_codigo_interno',
        'loj_nome',
        'loj_cnpj',
        'loj_urlapi',
        'loj_inscricao_estadual',
        'loj_telefone',
        'loj_endereco',
        'loj_endereco_numero',
        'loj_bairro',
        'loj_cidade',
        'loj_idestado',
        'loj_email',
        'loj_data_adicionado'
    ];
    
    public function rules()
    {
        return [
        'loj_nome' => 'required',
        'loj_cnpj' => 'required',
        'loj_urlapi' => ['required',Rule::unique('lojas')->ignore($this->loj_id,'loj_id')],
        'loj_inscricao_estadual' => 'required',
        'loj_telefone' => 'required',
        'loj_email' => 'required',
        'loj_endereco' => 'required',
        'loj_endereco_numero' => 'required',
        'loj_bairro' => 'required',
        'loj_cidade' => 'required',
        'loj_idestado' => 'required',
        ];
    }
    
    public function estados()
    {
        return $this->hasOne('app\models\State','id','loj_idestado');
    }
    
    public function getAtivas()
    {
        return $this->where('loj_status','ATIVO')->get();
    }
    
    public function getClienteOnSlave()
    {
        return DB::connection('slave_'.$this->loj_id)->table('clientes')->get();
    }
    
    public function getClienteVendasCheck($idCliente) 
    {
        return DB::connection('slave_'.$this->loj_id)
                ->table('contas_receber')
                ->join('contas_parcelas_receber','par_idconta','=','con_id')
                ->where('con_idcliente',$idCliente)
                ->where('par_idtipo_pagamento',4)
                ->get();
    }
    
    public function getVendasCheck() 
    {
        return DB::connection('slave_'.$this->loj_id)
                ->table('contas_receber')
                ->join('contas_parcelas_receber','par_idconta','=','con_id')
                ->join('clientes','cli_id','=','con_idcliente')
                ->where('par_idtipo_pagamento',4)
                ->get();
    }
    
    public function getSlaveVenda($idParcela) 
    {
        return DB::connection('slave_'.$this->loj_id)
                ->table('contas_receber')
                ->select('contas_parcelas_receber.*')
                ->join('contas_parcelas_receber','par_idconta','=','con_id')
                ->join('clientes','cli_id','=','con_idcliente')
                ->where('par_id',$idParcela)
                ->where('par_idtipo_pagamento',4)
                ->first();
    }
    
    public function cheques()
    {
        return $this->hasMany('App\models\Cheque','che_loja');
    }
    
    public function chequesAguardo()
    {
        return $this->cheques()->where('che_status','AGUARDANDO')->get();
    }
    
}

