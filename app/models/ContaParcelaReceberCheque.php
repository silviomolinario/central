<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ContaParcelaReceberCheque extends Model
{
    protected $table = 'contas_parcelas_receber_cheques';
    protected $primaryKey = 'relacao_id';
    public $timestamps = false;
    
    protected $fillable = [
        'relacao_idcheque',
        'relacao_idparcela',
    ];
}
