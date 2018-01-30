<?php

namespace App\Http\Controllers\Central;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\models\UsuarioTipoPermissao;

class PermissaoController extends Controller
{
    public function index()
    {
        $data['permissoes']    = \App\models\Permissao::all();
        $data['grupos']        = \App\models\PermissaoGrupo::all();
        $data['usuariosTipos'] = \App\models\UsuarioTipo::all();

        return view('central/permissao/index',$data);
    }
    
    public function store(Request $request, UsuarioTipoPermissao $usuarioTipoPermissao)
    {
        
        try{
            if($request->permissoes){
                
                DB::beginTransaction();
                
                # Deleta Todas as permissoes
                $usuarioTipoPermissao->truncate();
                
                foreach ($request->permissoes as $idUsuarioTipo => $permissao) {
                    
                    foreach ($permissao as $idPermissao) {
                        $usuarioTipoPermissao->create([
                            'perm_idtipo'   => $idUsuarioTipo,
                            'perm_idpermissao' => $idPermissao,
                        ]);
                    }
                    
                }
                
                DB::commit();
            }
            
            return redirect('central/configuracao/permissoes')->with('alert-success','Permissões atualizadas com sucesso');
            
        } catch (Exception $ex) {
            
            DB::roolback();
            
            return redirect('central/configuracao/permissoes')->with('alert-danger','Falha ao atualizar permissões com sucesso');
        }
    }
}
