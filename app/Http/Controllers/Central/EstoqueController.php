<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Estoque;
use App\models\Produto;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class EstoqueController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filterProduct()
    {
        $produtos = Produto::where('pro_status','!=','EXCLUIDO')->get();
        
        $data['produtos'] = converteArray($produtos,'pro_id','pro_nome');
        $data['titulo'] = 'Pesquisa de produto';
        return view('central/estoque/filterProduct',$data);
    }
    
    //{{url('central/estoque/index/PRATELEIRA')}}
    //{{url('central/estoque/index/LOJA')}}
    public function index()
    {
        return redirect('central/estoque/filterproduct');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        //
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) 
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) 
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
    
    public function productStock(Request $request)
    {
        $produto = Produto::find($request->produto);
        
        if(!$produto){
          
            return redirect('central/estoque/filterproduct')->with('alert-danger','Produto não encontrado!');
        }
        
        $lojas = \App\models\Loja::all();
        
        $array = [];
        
        foreach ($lojas AS $loja){
           
            try {   
                $client = new \GuzzleHttp\Client(['base_uri' => $loja->loj_urlapi]);
             
                $response = $client->request('POST','/api/produto-productstock',[
                    'form_params' => [
                        'pro_id' => $produto->pro_id,
                    ],
                    'connect_timeout' => 10.00
                ]);
            
                $estoque = json_decode($response->getBody()->getContents());
                
                if($estoque){
                    $loja->estoque = $estoque;
                    $array[] = $loja;
                }
                
                
        
            } catch (Exception $ex) {
            
            }    
        }
        
        $data['titulo'] = 'estoque';
        $data['lojas'] = $array;
        return view('central/estoque/index',$data);
    }
}

