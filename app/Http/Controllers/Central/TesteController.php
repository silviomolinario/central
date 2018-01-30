<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Categoria;
use App\Jobs\ProdutoJob;
use App\models\Cliente;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\models\Produto;

class TesteController extends Controller
{
    public function index()
    {
        // Create a client with a base URI
        $client  = new Client(['base_uri' => 'http://vendas.rpweb.com.br']);
        
        $produto  = Produto::find(1);
        
//        try {
            # Cadastra produto na loja
            $response = $client->request('POST', 'api/produto-store',[
                'form_params' => $produto->getAttributes()
            ]);

//        } catch (RequestException $e) {
//            
//            if ($e->hasResponse()) {
//                print_r($e->getResponse()->getBody()->getContents());
//            }
//        }
        
    }
    
    public function cliente() 
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://icone02.com']);
        $cliente  = Cliente::find(6);
        
        $dataCliente  = $cliente->getAttributes();
        $dataEndereco = $cliente->endereco->getAttributes();
        
        $movel = $cliente->contatos()->where('contato_tipo','MOVEL')->first();
        $fixo  = $cliente->contatos()->where('contato_tipo','FIXO')->first();
        $fax   = $cliente->contatos()->where('contato_tipo','FAX')->first();
        
        $contatos['contato'] = [];
        
        if($movel){
            $contatos['contato']['MOVEL'] = $movel->contato_numero;
        }
        
        if($fixo){
            $contatos['contato']['FIXO']  = $fixo->contato_numero;
            $contatos['contato_idoperadora'] = $movel->contato_idoperadora;
        }
        
        if($fax){
            $contatos['contato']['FAX']   = $fax->contato_numero;
        }
        
        $dataPost = array_merge($contatos,$dataCliente,$dataEndereco);
        
        try {
            # Cadastra produto na loja
            $response = $client->request('POST', 'api/cliente-store',[
                'form_params' => $dataPost
            ]);
            
        } catch (RequestException $e) {
            
            if ($e->getResponse()) {
                print_r($e->getResponse()->getBody()->getContents());die;
            }
        }
    }
}
