<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\models\Permissao;
use App\models\Usuario;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller 
{

    public function index()
    {
        $usuario = Usuario::where('usu_status', '<>', 'EXCLUIDO')->get();

        $data['usuarios'] = $usuario;
        $data['titulo']   = 'Lista';
        $data['pagina']   = "Usuário";
        return view('central/usuario/index', $data);
    }

    public function create()
    {
        $permissions = \App\models\UsuarioTipo::all();
        
        $data['titulo']      = 'Adição';
        $data['pagina']      = "Usuário";
        $data['permissoes']  = converteArray($permissions, 'tip_id', 'tip_nome');
        $data['tituloPanel'] = 'Cadastro Usuário';

        return view('central/usuario/add', $data);
    }

    public function store(Request $request)
    {

        $usuario = new Usuario;
        $this->validate($request, $usuario->rules());

        $usunome = $request->input('usu_nome');
        $usuusuario = $request->input('usu_usuario');
        $ususenha = $request->input('usu_senha');
        $usuemail = $request->input('usu_email');
        $usuidpermissao = $request->input('usu_idpermissao');
        $tipo = \App\models\UsuarioTipo::find($usuidpermissao);

        $usuario->usu_nome = $usunome;
        $usuario->usu_usuario = $usuusuario;
        $usuario->usu_senha = bcrypt($ususenha);
        $usuario->usu_email = $usuemail;
        $usuario->usu_data_adicionada = date('Y-m-d');


        try {

            DB::beginTransaction();
            $usuario->tipo()->associate($tipo);

            $usuario->save();
            DB::commit();
            # cadastro aprovado com sucesso
            return redirect("central/usuario")->with('alert-success', 'Cadastro foi efetivado com sucesso!');
        } catch (Exception $exc) {

            DB::rollBack();
            $request->session()->flash('alert-warning', 'Houve alguem erro! tente novamente mais tarde');
            return Redirect()->to("central/usuario/create");
        }
    }

    public function show($id) {
        //
    }

    public function edit($id)
    {
        $usuario = Usuario::find($id);
        $permissions = \App\models\UsuarioTipo::all();
        
        $data['titulo']      = 'Edição';
        $data['pagina']      = "Usuário";
        $data['permissoes'] = converteArray($permissions, 'tip_id', 'tip_nome');
        $data['tituloPanel'] = 'Edição do usuário';
        $data['usuario'] = $usuario;
        return view('central/usuario/add', $data);
    }

    public function update(Request $request) 
    {
        $id = $request->input('usu_id');
        $usuario = Usuario::find($id);

        $rules = $usuario->rules();
        unset($rules['usu_senha']);

        $this->validate($request, $rules);

        $usunome = $request->input('usu_nome');
        $usuusuario = $request->input('usu_usuario');
        $usuemail = $request->input('usu_email');
        $usuidpermissao = $request->input('usu_idpermissao');

        # Apenas atualiza senha se preenchido
        if ($request->input('usu_senha')) {
            $usuario->usu_senha = bcrypt($request->input('usu_senha'));
        }

        $tipo   = \App\models\UsuarioTipo::find($usuidpermissao);

        $usuario->usu_nome = $usunome;
        $usuario->usu_usuario = $usuusuario;
        $usuario->usu_email = $usuemail;

        try {

            DB::beginTransaction();
            $usuario->tipo()->associate($tipo);

            $usuario->save();
            DB::commit();
            # cadastro aprovado com sucesso
            $request->session()->flash('alert-success', 'Cadastro foi editado com sucesso!');
            return Redirect()->to("central/usuario");
        } catch (Exception $exc) {

            DB::rollBack();
            $request->session()->flash('alert-warning', 'Houve alguem erro! tente novamente mais tarde');
            return Redirect()->to("central/usuario/create");
        }
    }

    public function destroy( Request $request,$id)
    {
        $usuario = Usuario::find($id);
        $usuario->usu_status = "EXCLUIDO";
        
        try {
            
            DB::beginTransaction();
            $usuario->save();
            DB::commit();
            # cadastro excluido com sucesso
            $request->session()->flash('alert-success', 'Cadastro foi Excluido com sucesso');
            return Redirect::to('central/usuario');
        } catch (Exception $exc) {

            DB::rollBack();
            $request->session()->flash('alert-warming', 'Houve alguem erro! tente novamente mais tarde');
            return Redirect::to('central/usuario');
        }
    }

    public function block(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        $usuario->usu_status = "BLOQUEADO";
        
        try {
            
            DB::beginTransaction();
            $usuario->save();
            DB::commit();
            # cadastro excluido com sucesso
            $request->session()->flash('alert-success', 'Cadastro foi Bloqueado com sucesso');
            return Redirect()->to('central/usuario');
        } catch (Exception $exc) {

            DB::rollBack();
            $request->session()->flash('alert-warming', 'Houve alguem erro! tente novamente mais tarde');
            return Redirect()->to('central/usuario');
        }
    }

    public function unlock(Request $request,$id) 
    {
        $usuario = Usuario::find($id);
        $usuario->usu_status = "ATIVO";
        
        try {
            
            DB::beginTransaction();
            $usuario->save();
            DB::commit();
            # cadastro excluido com sucesso
            return redirect('central/usuario')->with('alert-success', 'Cadastro foi Desbloqueado com sucesso');
        } catch (Exception $exc) {

            DB::rollBack();
            $request->session()->flash('alert-warming', 'Houve alguem erro! tente novamente mais tarde');
            return Redirect::back('central/usuario');
        }
    }

}
