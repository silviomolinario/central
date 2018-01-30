<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\models\Loja;

class MensagemController extends Controller
{
    public function create()
    {
        $data['lojas'] = converteArray(\App\models\Loja::all(), 'loj_id', 'loj_nome');
        $data['titulo'] = 'Caixa de mensagem';
        return view('central/mensagem/add',$data);
    }
    
    public function store(Request $request)
    {
        $data = $request->except('_token');

        $caixaMensagem = new \App\models\Mensagem();
        $this->validate($request, $caixaMensagem->rules());
        
        $data['men_data_adicionado'] = date('Y-m-d H:i:s');
       
        try {
            DB::beginTransaction();
            //inserindo mensagem
            $mensagem = $caixaMensagem->create($data);
//            var_dump($mensagem);die;
            DB::commit();
            //pegando lojas ativas
            $loja = Loja::where('loj_id',[$mensagem['men_idloja']])->first();
            
            dispatch(new \App\Jobs\MensagemJob($loja->loj_id,$mensagem->men_id));
            
            //mensagem inserida com sucesso
            return redirect('central/caixa-mensagem/create')->with('alert-success','Mensagem enviada com sucesso!');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect('central/caixa-mensagem/create')->with('alert-danger','Houve um erro tente novamente!');
        }
    }
    
}
