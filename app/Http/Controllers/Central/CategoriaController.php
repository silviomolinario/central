<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Categoria;
use App\models\Loja;
use \Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoria = Categoria::where('cat_status', '!=', '2')->get();
        $data['categorias'] = $categoria;
        return view('central/categoria/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['titulo'] = 'Cadastro de categoria';
        return view('central/categoria/add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->except('_token');
        
        $categoria = new Categoria;
        $this->validate($request, $categoria->rules());
        
        $data['cat_data_adicionado'] = date('Y-m-d H:i:s');

        try {

            DB::beginTransaction();
            $categoria = $categoria->create($data);
            DB::commit();
            
            $lojas = new Loja();
            $lojas = $lojas->getAtivas();

            # Dispara jobs para lojas
            if(count($lojas)){
                foreach ($lojas as $loja) {
                    dispatch(new \App\Jobs\CategoriaJob($loja->loj_id,$categoria->cat_id));
                }
            } 
            
            # cadastro aprovado com sucesso
            return redirect("central/categoria")->with('alert-success', 'Categoria foi efetivado com sucesso!');
        } catch (Exception $exc) {

            DB::rollBack();
            $request->session()->flash('alert-warning', 'Houve alguem erro! tente novamente mais tarde');
            return Redirect()->to("central/categoria/create");
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
        $categoria = Categoria::find($id);

        
        $data['categoria'] = $categoria;
        $data['titulo'] = "Edição de categoria";

        return view('central/categoria/add', $data);
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
        $categoria = Categoria::find($data['cat_id']);
        # Validação
        $this->validate($request, $categoria->rules());
        
        try {

            DB::beginTransaction();
            $categoria->update($data);
            DB::commit();
            # cadastro aprovado com sucesso
            return redirect("central/categoria")->with('alert-success', 'Categoria foi editada com sucesso!');
        } catch (Exception $exc) {

            DB::rollBack();
            $request->session()->flash('alert-warning', 'Houve alguem erro! tente novamente mais tarde');
            return Redirect()->to("central/categoria/edit");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $categoria = Categoria::find($id);
        $categoria->cat_status = 2;

        try {

            DB::beginTransaction();
            $categoria->save();
            DB::commit();
            # cadastro aprovado com sucesso
            return redirect("central/categoria")->with('alert-success', 'Categoria excluida com sucesso!');
        } catch (Exception $exc) {

            DB::rollBack();
            $request->session()->flash('alert-warning', 'Houve alguem erro! tente novamente mais tarde');
            return Redirect()->to("central/categoria");
        }
    }

}
