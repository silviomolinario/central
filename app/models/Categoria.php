<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Categoria extends Model {

    protected $table = 'categorias';
    protected $primaryKey = 'cat_id';
    public $timestamps = false;
    protected $fillable = [
        'cat_codigo',
        'cat_nome',
        'cat_data_adicionado'
    ];
    
    public function rules() {
        return [
            'cat_codigo'          => [Rule::unique('categorias')->ignore($this->cat_id, 'cat_id')],
            'cat_nome'            => 'required',
        ];
    }
    
}
