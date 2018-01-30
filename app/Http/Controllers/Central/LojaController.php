<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Loja;
use Illuminate\Support\Facades\DB;

class LojaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loja = Loja::where('loj_status','!=','EXCLUIDO')->get();
        
        $data['titulo']= 'lojas';
        $data['lojas'] = $loja;
        return view('central/loja/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data['estados'] = converteArray(\App\models\State::all(), 'id', 'name');
        $data['titulo'] = 'adição de loja';
        return view('central/loja/add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        var_dump($request->toArray());die;
        $data = $request->except('_token');
        
        $loja = New Loja();
        $this->validate($request, $loja->rules());
        
        
        try{
            DB::beginTransaction();
            
            # Data Adicionada
            $data['loj_data_adicionado'] = date('Y-m-d H:i:s');
            # Código interno
            $data['loj_codigo_interno'] = DB::select('SELECT GENERATE_CODE() AS codigo')[0]->codigo;
            
            $loja->create($data);
             
            DB::commit();
            
            return redirect("central/loja")->with('alert-success', 'loja foi adicionada com sucesso!');
            
        } catch (Exception $ex) {
            DB::rollBack();
            
            $request->session()->flash('alert-warning', 'Houve alguem erro! tente novamente mais tarde');
            
            return Redirect()->to("central/loja/create");
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
    public function edit($id)
    {
        $loja = Loja::find($id);
        
        $data['estados'] = converteArray(\App\models\State::all(), 'id', 'name');
        $data['loja'] = $loja;
        $data['titulo'] = 'edição de loja';
        return view('central/loja/add',$data);
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
        
        $loja = Loja::find($data['loj_id']);
        $this->validate($request, $loja->rules());
        
         try{
            DB::beginTransaction();
            $data['loj_data_atualizada'] = date('Y-m-d H:i:s');
            
             $loja->update($data);
             
            DB::commit();
            
            return redirect("central/loja")->with('alert-success', 'loja foi editada com sucesso!');
            
        } catch (Exception $ex) {
            DB::rollBack();
            
            $request->session()->flash('alert-warning', 'Houve alguem erro! tente novamente mais tarde');
            
            return Redirect()->to("central/loja/edit");
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
        $loja = Loja::find($id);
        $loja->loj_status = 'EXCLUIDO';
        
        try{
            DB::beginTransaction();
            
            $loja->save();
             
            DB::commit();
            
            return redirect("central/loja")->with('alert-success', 'loja foi excluido com sucesso!');
            
        } catch (Exception $ex) {
            DB::rollBack();
            
            $request->session()->flash('alert-warning', 'Houve alguem erro! tente novamente mais tarde');
            
            return Redirect()->to("central/loja");
        }
    }
    
    public function getAllLojas()
    {
        return Loja::all();
    }
}
