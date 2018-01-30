<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Cliente;
use App\models\ClienteEndereco;
use App\models\ClienteContato;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ApiClienteController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        # Se cliente já existir não insere
        if(Cliente::where('cli_identificacao',$data['cli_identificacao'])->first()){
           exit; 
        }
        
        # Validação Cliente
        $cliente = new Cliente;
        # Validação Endereço
        $endereco = new ClienteEndereco;
        #Validação contato
        $contato = new ClienteContato;
        
        try {
            
            #Inicial transação
            DB::beginTransaction();
            
            # Insere cliente
            $data['cli_data_adicionado'] = date('Y-m-d H:i:s');
            $cliente = $cliente->create($data);
            $cliente->cli_codigo_central = $cliente->cli_id;
            $cliente->save();
            # Insere endereço
            $cliente->endereco()->create($data);

            # Insere contatos
            if(isset($data['contato'])){
                foreach ($data['contato'] AS $tipo => $numero) {

                    if($tipo == 'MOVEL'){
                        $cliente->addContato($numero, $tipo, $data['contato_idoperadora']);
                    } else {
                        $cliente->addContato($numero, $tipo);
                    }
                }
            }
            
            DB::commit();
            
            $loja = new \App\models\Loja();
            $lojas = $loja->getAtivas();
            
            # Dispara Cadastro para outras lojas
            if(count($lojas)){
                foreach ($lojas as $loja) {
                    if($data['loj_codigo_interno'] != $loja->loj_codigo_interno){
                       // dispatch(new \App\Jobs\ClienteJob($loja->loj_id,$cliente->cli_id));
                    //}  else {
                        
                        $data = [
                          'cli_codigo_venda' => $cliente->cli_codigo_venda,  
                          'cli_codigo_central' => $cliente->cli_codigo_central,  
                        ];
                        dispatch(new \App\Jobs\ClienteCodigoCentralUpdateJob($loja->loj_id,$data));
                    }
                }
            }
            
        } catch (Exception $exc) {
            DB::rollBack();
        }
    }
}
