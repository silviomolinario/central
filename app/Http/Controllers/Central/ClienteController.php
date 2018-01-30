<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Cliente;
use App\models\ClienteEndereco;
use App\models\ClienteContato;
use App\models\Endereco_uf;
use App\models\Operadora;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $cliente = Cliente::where('cli_status', '!=', 'EXCLUIDO')->get();
        $data['clientes'] = $cliente;

        return view('central/cliente/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $endereco = Endereco_uf::all();
        $operadora = Operadora::all();

        $data['estados'] = converteArray($endereco, 'uf_id', 'uf_nome');
        $data['operadoras'] = converteArray($operadora, 'ope_id', 'ope_nome');
        $data['titulo'] = 'cadastro cliente';

        return view('central/cliente/add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->except('_token');

        # Validação Cliente
        $cliente = new Cliente;
        $this->validate($request, $cliente->rules);

        # Validação Endereço
        $endereco = new ClienteEndereco;
        $this->validate($request, $endereco->rules);

        #Validação contato
        $contato = new ClienteContato;
        $this->validate($request, $contato->rules);

        try {
            #Inicial transação
            DB::beginTransaction();

            # Insere cliente
            $data['cli_data_adicionado'] = date('Y-m-d H:i:s');
            $cliente = $cliente->create($data);

            # Insere endereço
            $cliente->endereco()->create($data);

            # Insere contatos
            foreach ($data['contato'] AS $tipo => $numero) {

                if ($tipo == 'MOVEL') {
                    $cliente->addContato($numero, $tipo, $data['contato_idoperadora']);
                } else {
                    $cliente->addContato($numero, $tipo);
                }
            }

            DB::commit();
            
            dispatch(new \App\Jobs\ClienteJob($cliente->cli_id));
            
            return redirect("central/cliente")->with('alert-success', 'Cliente foi adicionado com sucesso!');
        } catch (Exception $exc) {
            DB::rollBack();
            return redirect("central/cliente")->with('alert-danger', 'Falha ao adicionar cliente!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $cliente = Cliente::find($id);
        $endereco = Endereco_uf::all();
        $operadora = Operadora::all();

        $fixo = $cliente->contatos()->where('contato_tipo', 'FIXO')->first()->contato_numero;
        $movel = $cliente->contatos()->where('contato_tipo', 'MOVEL')->first()->contato_numero;
        $fax = $cliente->contatos()->where('contato_tipo', 'FAX')->first()->contato_numero;
        $contoperadora = $cliente->contatos()->where('contato_tipo', 'MOVEL')->first()->contato_idoperadora;

        $data['operadora'] = $contoperadora;
        $data['fixo'] = $fixo;
        $data['movel'] = $movel;
        $data['fax'] = $fax;
        $data['estados'] = converteArray($endereco, 'uf_id', 'uf_nome');
        $data['operadoras'] = converteArray($operadora, 'ope_id', 'ope_nome');
        $data['cliente'] = $cliente;
        $data['titulo'] = 'Edição de cliente';
        return view('central/cliente/add', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $data = $request->except('_token');

        # Validação Cliente
        $cliente = Cliente::find($data['cli_id']);
        $this->validate($request, $cliente->rules);

        # Validação Endereço
        $endereco = $cliente->endereco;
        $this->validate($request, $endereco->rules);

        #Validação contato
        $contato = new ClienteContato();
        $this->validate($request, $contato->rules);

        try {
            #Inicial transação
            DB::beginTransaction();
            $data['cli_data_atualizada'] = date('Y-m-d H:i:s');
            # Insere cliente
            $cliente->update($data);

            # Insere endereço
            $cliente->endereco->update($data);

            # Insere contatos
            foreach ($data['contato'] AS $tipo => $numero) {

                if ($tipo == 'MOVEL') {
                    $cliente->addContato($numero, $tipo, $data['contato_idoperadora']);
                } else {
                    $cliente->addContato($numero, $tipo);
                }
            }

            DB::commit();

            return redirect("central/cliente")->with('alert-success', 'Cliente foi editato com sucesso!');
        } catch (Exception $exc) {
            DB::rollback();
            return redirect("central/cliente")->with('alert-danger', 'Falha ao edita o cliente!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $cliente = Cliente::find($id);
        $cliente->cli_status = 'EXCLUIDO';

        try {
            DB::beginTransaction();
            $cliente->save();

            DB::commit();

            return redirect("central/cliente")->with('alert-success', 'Cliente foi excluido com sucesso!');
        } catch (Exception $ex) {
            DB::rollback();
            return redirect("central/cliente")->with('alert-danger', 'Falha ao excluir cliente!');
        }
    }

    public function block($id)
    {

        $cliente = Cliente::find($id);
        $cliente->cli_status = 'INATIVO';
        
        try {
            DB::beginTransaction();
            $cliente->save();

            DB::commit();
            
            $lojas = new \App\models\Loja;
            $lojas = $lojas->getAtivas();
            #bloqueia cliente em todas lojas externas
            #Dispara jobs para todas as lojas
            if(count($lojas)){
                foreach ($lojas AS $loja){
                    dispatch(new \App\Jobs\ClienteBlockJob($loja->loj_id,$cliente->cli_codigo_central));
                }
            }

            return redirect("central/cliente")->with('alert-success', 'Cliente foi bloqueado com sucesso!');
        } catch (Exception $ex) {
            DB::rollback();
            return redirect("central/cliente")->with('alert-danger', 'Falha ao bloquear o cliente!');
        }
    }

    public function unlock($id) {

        $cliente = Cliente::find($id);
        $cliente->cli_status = 'ATIVO';
        
        try {
            DB::beginTransaction();
            $cliente->save();

            DB::commit();
            
            $lojas = new \App\models\Loja;
            $lojas = $lojas->getAtivas();
            #desbloqueia cliente em todas as lojas externas
            #dispara jobs para todas as lojas
            if(count($lojas)){
                foreach($lojas AS $loja){
                    dispatch(new \App\Jobs\ClienteUnlockJob($loja->loj_id,$cliente->cli_codigo_central));
                    
                }
            }
            
            return redirect("central/cliente")->with('alert-success', 'Cliente foi desbloqueado com sucesso!');
        } catch (Exception $ex) {
            DB::rollback();
            return redirect("central/cliente")->with('alert-danger', 'Falha ao desbloquear o cliente!');
        }
    }
    
    
    /**
     * Get All cliente Ajax
     */
    public function getAll(Cliente $cliente)
    {
        return $cliente->ativos();
    }
}
