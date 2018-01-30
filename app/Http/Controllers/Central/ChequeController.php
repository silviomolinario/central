<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Cheque;
use App\models\Banco;
use App\models\Loja;
use Illuminate\Support\Facades\DB;
use Validator;
use App\models\Cliente;

class ChequeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->che_loja){
            $cheques = Cheque::where('che_loja',$request->che_loja)->get();
        } else {
            $cheques = Cheque::get();
        }
        
        $lojas =  Loja::all();
        
        $data['lojas'] = converteArray($lojas,'loj_id','loj_nome');
        $data['cheques'] = $cheques;
        $data['titulo'] = 'cheques';
        return view('central/cheque/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Cliente $cliente)
    {
        $bancos = Banco::all();
        $lojas  =  Loja::all();
        
        $data['bancos']   = converteArray($bancos,'ban_codigo','ban_nome');
        $data['lojas']    = converteArray($lojas,'loj_id','loj_nome');
        
        $clientes = $cliente->ativos();
        $data['clientes'] = [null => ''] +  converteArray($clientes,'cli_id','cli_nome');
        
        $data['situacoes'] = [
            'AGUARDANDO'=> 'AGUARDANDO', 
            'REPASSADO' => 'REPASSADO' ,
            'DEVOLVIDO' => 'DEVOLVIDO' , 
            'RECEBIDO'  => 'RECEBIDO'  ,  
            'EXCLUIDO'  => 'EXCLUIDO'  
        ];
        
        $data['titulo'] = 'Cadastro de cheque';
        
        return view('central/cheque/add',$data);
    }
    
    public function readerCreate()
    {
        $bancos = Banco::all();
        
        $data['bancos'] = converteArray($bancos,'ban_codigo','ban_nome');
        
        $data['titulo'] = 'Cadastro de cheque';
        return view('central/cheque/add_leitor',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        
        //validação cheque
        $cheque = new Cheque();
        $this->validate($request, $cheque->rules());
        
        if($request->che_status == 'REPASSADO'){
            $this->validate($request, [
                'che_cliente_repassado' => 'required'
            ]);
        }
        
        try {
            
            $banco = Banco::where('ban_codigo',$data['che_banco_codigo'])->first();
                
            if(!$banco){
                $response['erros']  = 'Banco não encontrado';
                $response['status'] = 'failed';
                return $response;
            }
            
            
            DB::beginTransaction();
            
            $data['che_idbanco'] = $banco->ban_id;
            //insere cheque
            $data['che_data_emissao']    = convertData($data['che_data_emissao']);
            $data['che_data_vencimento'] = convertData($data['che_data_vencimento']);
            
            $data['che_data_adicionado'] = date('Y-m-d H:i:s');
            $data['che_valor'] = convertFloat($data['che_valor']);
            $cheque->create($data);
            
            DB::commit();
            
            return redirect('central/cheque')->with('alert-success', 'Cheque foi adicionado com sucesso!');
        } catch (Exception $ex) {
            DB::rollback();
            return redirect('central/cheque')->with('alert-danger','Falha ao adicionar Cheque!');
        }
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function readerStore(Request $request)
    {
        $data = $request->except('_token');
        //validação cheque
        $cheque = new Cheque();
        
        $rules = $cheque->rules();
        
        if($request['che_status'] == 'REPASSADO'){
            $rules = $rules + ['che_cliente_repassado' => 'required'];
        } 
        
        $validation = Validator::make($request->all(),$cheque->rules(),$cheque->messages());
        
        $response = [];
        $errosMessage = '';
        
        if($validation->fails()){
            
            foreach ($validation->errors()->messages() as $error) {
                foreach ($error as $key => $value) {
                    if($key == 0){
                        $errosMessage .= '<br>'.$value;
                    } else {
                        $errosMessage .= $value.'<br>';
                    }
                    
                }
            }
            
            $response['erros']  = $errosMessage;
            $response['status'] = 'failed';
            return $response;
            
        } else {
            try {

                $banco = Banco::where('ban_codigo',$data['che_banco_codigo'])->first();
                
                if(!$banco){
                    $response['erros']  = 'Banco não encontrado';
                    $response['status'] = 'failed';
                    return $response;
                }
                
                DB::beginTransaction();

                $data['che_idbanco'] = $banco->ban_id;
                //insere cheque
                $data['che_data_emissao']    = convertData($data['che_data_emissao']);
                $data['che_data_vencimento'] = convertData($data['che_data_vencimento']);

                $data['che_data_adicionado'] = date('Y-m-d H:i:s');
          
                # Se não repassado, che_cliente_repassado é nulo
                if($request['che_status'] != 'REPASSADO'){
                    $data['che_cliente_repassado'] = null;
                } 
                
                $cheque->create($data);

                DB::commit();

                $response['erros']  = $errosMessage;
                $response['status'] = 'success';
                
                return $response;
                
            } catch (Exception $ex) {
                
                DB::rollBack();
                $response['erros']  = $errosMessage;
                $response['status'] = 'failed';
                
                return $response;
            }
        }
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
    public function edit(Cliente $cliente, $id)
    {
        $cheque = Cheque::find($id);
        $bancos = Banco::all();
        $lojas =  Loja::all();
        
        $clientes = $cliente->ativos();
        $data['clientes'] = [null => ''] + converteArray($clientes,'cli_id','cli_nome');
        
        $data['situacoes'] = [
            'AGUARDANDO'=> 'AGUARDANDO', 
            'REPASSADO' => 'REPASSADO' ,
            'DEVOLVIDO' => 'DEVOLVIDO' , 
            'RECEBIDO'  => 'RECEBIDO'  ,  
            'EXCLUIDO'  => 'EXCLUIDO'  
        ];
        
        $data['lojas'] = converteArray($lojas,'loj_id','loj_nome');
        $data['cheque'] = $cheque;
        $data['bancos'] = converteArray($bancos,'ban_codigo','ban_nome');
        $data['titulo'] = 'edição de cheque';
        return view('central/cheque/add',$data);
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
        $data = $request->except('_token');
        
        $cheque = Cheque::find($data['che_id']);
        $this->validate($request, $cheque->rules());
        
        if($request['che_status'] == 'REPASSADO'){
            $rules = $rules + ['che_cliente_repassado' => 'required'];
        } 
        
        try {
            
            $banco = Banco::where('ban_codigo',$data['che_banco_codigo'])->first();

            if(!$banco){
                $response['erros']  = 'Banco não encontrado';
                $response['status'] = 'failed';
                return $response;
            }

            DB::beginTransaction();

            $data['che_idbanco'] = $banco->ban_id;
            //insere cheque
            
            $data['che_data_emissao']    = convertData($data['che_data_emissao']);
            $data['che_data_vencimento'] = convertData($data['che_data_vencimento']);
            $data['che_data_atualizada'] = date('Y-m-d H:i:s');
            $data['che_valor']           = convertFloat($data['che_valor']);
            
            # Se não repassado, che_cliente_repassado é nulo
            if($request['che_status'] != 'REPASSADO'){
                $data['che_cliente_repassado'] = null;
            } 
            
            //insere cheque
            $cheque->update($data);
            
            DB::commit();
            
            return redirect('central/cheque')->with('alert-success', 'Cheque foi editado com sucesso!');
        } catch (Exception $ex) {
            DB::rollback();
            return redirect('central/cheque')->with('alert-danger','Falha ao editar Cheque!');
        }
    }

    /**
     * Remove the specified resource from storage. 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cheque = Cheque::find($id);
        $cheque->che_status = 'EXCLUIDO';
        
        try {
             DB::beginTransaction();
             $cheque->save();
             
             DB::commit();
             return redirect('central/cheque')->with('alert-success', 'Cheque foi excluir com sucesso!');
        }catch (Exception $ex) {
             DB::rollback();
            return redirect('central/cheque')->with('alert-danger','Falha ao excluir Cheque!');
        }
    }
    
    public function getAllBanks()
    {
        return Banco::all();
    }
    
    public function getStoreClientes($idLoja)
    {
        $loja = Loja::find($idLoja);
        
        if($loja){
            return $loja->getClienteOnSlave();
        }
    }
    
    public function getClienteVendasCheck($idLoja,$idCliente)
    {
        $loja = Loja::find($idLoja);
        
        if($loja){
            return $loja->getClienteOnSlave($idCliente);
        }
    }
    
    public function getByCmc7(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'cmc7' => 'required'
        ],[
            'cmc7.required' => 'Cheque não encontrado'
        ]);
        
        $response = [];
        $errosMessage = '';
        
        if($validation->fails()){
            
            foreach ($validation->errors()->messages() as $error) {
                foreach ($error as $key => $value) {
                    if($key == 0){
                        $errosMessage .= $value;
                    } else {
                        $errosMessage .= $value;
                    }
                    
                }
            }
            
            $response['erros']  = $errosMessage;
            $response['status'] = 'failed';
            return $response;
            
        } else {

            try{
                
                $cmc7 = $request['cmc7'];
            
                $cheque = Cheque::where('che_numero_cheque',$cmc7)->first();
                
                if(!$cheque){
                    $response['erros']  = "Cheque não encontrado";
                    $response['status'] = 'failed';
                    return $response;
                }

                $cheque->banco->ban_nome;
                
                $response['cheque'] = $cheque;
                $response['erros']  = $errosMessage;
                $response['status'] = 'success';

                return $response;
                
            } catch (Exception $ex) {
                $response['erros']  = "Cheque não encontrado";
                $response['status'] = 'failed';
                return $response;
            }
            
        }
    }
}
