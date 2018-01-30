<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Categoria;
use App\models\Produto;
use App\models\Loja;
use \Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $produtos = Produto::where('pro_status', '!=', 'EXCLUIDO')->get();
        $data['produtos'] = $produtos;
        return view('central/produto/index', $data);
    }

    public function create()
    {
        $categorias = Categoria::all()->where('cat_status', '==', 1);
        $data['titulo'] = 'Cadastro de Produto';
        $data['categorias'] = converteArray($categorias, 'cat_id', 'cat_nome');

        return view('central/produto/add', $data);
    }
    
    public function createDerivado($idProduto)
    {
        $produto = Produto::find($idProduto);
        
        if(!$produto OR $produto->pro_codigo_principal != $produto->pro_codigo_secundario){
            return redirect('central/produto/create')->with('alert-warning','Produto não encontrato!');
        }
        
        $categorias = Categoria::all()->where('cat_status', '==', 1);
        $data['produto'] = $produto;
        $data['titulo']  = 'Cadastro de Produto Derivado';
        $data['categorias'] = converteArray($categorias, 'cat_id', 'cat_nome');

        
        return view('central/produto/add_derivado', $data);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['pro_data_adicionada'] = date('Y-m-d H:i:s');

        $produto = new Produto();

        $rules = $produto->rules();
        unset($rules['pro_status']);
        # Validação
        $this->validate($request, $rules);

        try {
            
            #convert Preço
            $data['pro_preco'] = convertFloat($data['pro_preco']);
            # Gera Código grupo
            $data['pro_codigo_principal'] = ($data['pro_codigo_principal'])? $data['pro_codigo_principal'] : DB::select('SELECT PRODUTO_CODE() AS codigo')[0]->codigo;
            # Grupo do produto, estamos usando o campo código segundario
            $data['pro_codigo_secundario'] = $data['pro_codigo_principal'];
            # Código do produto, contatemamos código do produto com código do grupo
            $data['pro_codigo_principal'] = $data['pro_codigo_principal'] . $request->pro_codigo_secundario;
            
            # Verifica se produto existe
            if($produto->where('pro_codigo_principal',$data['pro_codigo_principal'])->first()){
                return Redirect('central/produto/create')->with('alert-warning','Produto já existe!');
            }

            DB::beginTransaction();
            
            $produto = $produto->create($data);
            
            DB::commit();

            $lojas = new Loja();
            $lojas = $lojas->getAtivas();
            # Cadastra Produto em lojas externas
            # Dispara jobs para lojas
            if(count($lojas)){
                foreach ($lojas as $loja) {
                    dispatch(new \App\Jobs\ProdutoJob($loja->loj_id,$produto->pro_id));
                }
            } 

            # cadastro aprovado com sucesso
            return redirect("central/produto")->with('alert-success', 'Produto foi efetivado com sucesso!');
        } catch (Exception $exc) {

            DB::rollBack();
            $request->session()->flash('alert-warning', 'Houve alguem erro! tente novamente mais tarde');
            return Redirect()->to("central/produto/create");
        }
    }
    
    public function storeDerivado(Request $request,$idPrincipal)
    {
        # Monta validação
        $rules = [
            "pro_nome"              => "required",
            "pro_codigo_secundario" => "required",
            "pro_prateleira"        => "required",
            "pro_preco"             => "required",
            "pro_status"            => "required",
        ];
        
        # Validação
        $this->validate($request, $rules);

        try {
            
            $produtoPrincipal = Produto::find($idPrincipal);
            
            # Monta produto replicando algumas caracteristica do produto principal
            $data = [
                "pro_idcategoria"       => $produtoPrincipal->pro_idcategoria,
                "pro_codigo_principal"  => $produtoPrincipal->pro_codigo_principal . $request->pro_codigo_secundario,
                "pro_codigo_secundario" => $produtoPrincipal->pro_codigo_principal,
                "pro_codigo_fabricante" => $produtoPrincipal->pro_codigo_fabricante,
                "pro_codigo_barra"      => $request->pro_codigo_barra,
                "pro_nome"              => $request->pro_nome,
                "pro_descricao"         => $request->pro_descricao,
                "pro_cfop"              => $produtoPrincipal->pro_cfop,
                "pro_medida"            => $produtoPrincipal->pro_medida,
                "pro_prateleira"        => $request->pro_prateleira,
                "pro_status"            => $request->pro_status,
                "pro_preco"             => convertFloat($request->pro_preco),
                'pro_data_adicionada'   => date('Y-m-d H:i:s')
            ];
                    
            
            $produto = new Produto();
            
            # Verifica se produto existe
            if($produto->where('pro_codigo_principal',$data['pro_codigo_principal'])->first()){
                return Redirect('central/produto/create')->with('alert-warning','Produto já existe!');
            }

            DB::beginTransaction();
            
            $produto = $produto->create($data);
            
            DB::commit();

            $lojas = new Loja();
            $lojas = $lojas->getAtivas();
            # Cadastra Produto em lojas externas
            # Dispara jobs para lojas
            if(count($lojas)){
                foreach ($lojas as $loja) {
                    dispatch(new \App\Jobs\ProdutoJob($loja->loj_id,$produto->pro_id));
                }
            } 

            # cadastro aprovado com sucesso
            return redirect("central/produto")->with('alert-success', 'Produto foi efetivado com sucesso!');
        } catch (Exception $exc) {

            DB::rollBack();
            $request->session()->flash('alert-warning', 'Houve alguem erro! tente novamente mais tarde');
            return Redirect()->to("central/produto/create");
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $produto = Produto::find($id);
        $categorias = Categoria::all();
        
        if($produto->pro_codigo_principal == $produto->pro_codigo_secundario){
            $data['derivados'] = $produto->derivados();
        } else {
            $data['derivante']  = $produto->derivante();
        }

        $data['categorias'] = converteArray($categorias, 'cat_id', 'cat_nome');
        $data['produto'] = $produto;
        $data['titulo'] = 'Edição de produto';
        
        return view('central/produto/add', $data);
    }

    public function update(Request $request) 
    {
        $data    = $request->except('_token');
        $produto = Produto::find($data['pro_id']);
        
        $rules = $produto->rules();
        unset($rules['pro_codigo_fabricante']);
        unset($rules['pro_cfop']);
        unset($rules['pro_codigo_principal']);
        # Validação
        $this->validate($request,$rules);
        
        try {
            DB::beginTransaction();
            
            #Converte Preço
            $data['pro_preco'] = convertFloat($data['pro_preco']);
            # Código Produto
            $produto->update($data);
            
            DB::commit();
            
            $lojas = new Loja();
            $lojas = $lojas->getAtivas();
            # atualiza Produto em lojas externas
            # Dispara jobs para lojas
            if(count($lojas)){
                foreach ($lojas AS $loja){
                    dispatch(new \App\Jobs\ProdutoUpdate($loja->loj_id, $data));
                }
            }
            
            # produto editado com sucesso
            $request->session()->flash('alert-success', 'Produto foi editado com sucesso');
            return Redirect::to('central/produto');
        } catch (Exception $exc) {

            DB::rollBack();
            $request->session()->flash('alert-warming', 'Houve alguem erro! tente novamente mais tarde');
            return Redirect::to('central/produto');
        }
    }

    public function destroy(Request $request, $id)
    {
        $produto = Produto::find($id);
        $produto->pro_status = 'EXCLUIDO';

        try {
            DB::beginTransaction();
            $produto->save();
            DB::commit();
            
            $lojas = new Loja();
            $lojas = $lojas->getAtivas();
            # atualiza Produto em lojas externas
            # Dispara jobs para lojas
            
            if(count($lojas)){
                foreach ($lojas AS $loja){
                    dispatch(new \App\Jobs\ProdutoDestroy($loja->loj_id,$produto->pro_id));
                }
            }
            
            # cadastro excluido com sucesso
            $request->session()->flash('alert-success', 'Produto foi Excluido com sucesso');
            return Redirect::to('central/produto');
        } catch (Exception $exc) {

            DB::rollBack();
            $request->session()->flash('alert-warming', 'Houve alguem erro! tente novamente mais tarde');
            return Redirect::to('central/produto');
        }
    }

}
