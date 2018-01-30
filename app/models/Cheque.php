<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Cheque extends Model
{
    protected $table = 'cheques';
    protected $primaryKey = 'che_id';
    public $timestamps = false;
    
    protected $fillable = [
        'che_idbanco',
        'che_agencia',
        'che_conta',
        'che_numero_cheque',
        'che_emitente',
        'che_cnpj_cpf',
        'che_telefone',
        'che_data_emissao',
        'che_data_vencimento',
        'che_valor',
        'che_observacao',
        'che_data_adicionado',
        'che_loja',
        'che_comp',
        'che_status',
        'che_cliente_repassado'
    ];
    
    public function rules() {
        
        return [
            'che_banco_codigo'    => 'required',
            'che_agencia'         => 'required',
            'che_conta'           => 'required',
            'che_numero_cheque'   => ['required',Rule::unique('cheques')->ignore($this->che_id, 'che_id')],
            'che_emitente'        => 'required',
            'che_cnpj_cpf'        => 'required',
            'che_telefone'        => 'required',
            'che_data_emissao'    => 'required',
            'che_data_vencimento' => 'required',
            'che_valor'           => 'required',
            'che_loja'            => 'required',
            'che_comp'            => 'required',
            'che_status'          => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'che_banco_codigo.required' => 'Campo Banco é obrigatório',
            'che_agencia.required' => 'Campo Agencia é obrigatório',
            'che_conta.required' => 'Campo Conta é obrigatório',
            'che_numero_cheque.required' => 'Campo Número Cheque é obrigatório',
            'che_numero_cheque.unique' => 'Este número de cheque já foi cadastrado!',
            'che_emitente.required' => 'Campo Emitente é obrigatório',
            'che_cnpj_cpf.required' => 'Campo Cpf é obrigatório',
            'che_telefone.required' => 'Campo Telefone é obrigatório',
            'che_data_emissao.required' => 'Campo Data de emissão é obrigatório',
            'che_data_vencimento.required' => 'Campo Data de vencimento é obrigatório',
            'che_valor.required' => 'Campo Valor é obrigatório',
            'che_loja.required' => 'Campo Loja é obrigatório',
            'che_comp.required' => 'Campo Comp é obrigatório',
            'che_status.required' => 'Campo Status é obrigatório',
            'che_cliente_repassado.required' => 'Cliente de repasse é obrigatório',
        ];
    }
    
    public function banco() {
        
        return $this->hasOne('App\models\Banco','ban_id','che_idbanco');
    }
    
    public function loja() {
        
        return $this->hasOne('App\models\Loja','loj_id','che_loja');
    }
    
    public function hasParcela() {
        
        return $this->hasOne('App\models\ContaParcelaReceberCheque','relacao_idcheque');
    }
    
    public function venda($idParcela)
    {
        return ContaParcelaReceberCheque::where('relacao_idparcela',$idParcela)->first();
    }
}
