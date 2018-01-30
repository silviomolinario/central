<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class Mensagem extends Model
{
    protected $table = 'mensagens';
    protected $primaryKey = 'men_id';
    public $timestamps = false;
    protected $fillable = [
        'men_idloja',
        'men_descricao',
        'men_titulo',
        'men_data_adicionado',
    ];
    
    public function rules()
    {
        return [
            'men_descricao' => 'required',
            'men_titulo' => 'required',
            'men_idloja' => 'required',
        ];
    }
}