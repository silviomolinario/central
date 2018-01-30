@extends('layouts.app')

@section('content')

<div class="row">
    
    <div class="col-md-6">
        <div class="panel panel-default no-bd">
            <div class="panel-header bg-dark">
                <h2 class="panel-title">{{$tituloPanel}}</h2>
            </div>
            <div class="panel-body bg-white">
                
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        @if(isset($usuario)) 
                        <form role="form" class="form-horizontal form-validation" method="POST" action="{{url('central/usuario/update')}}">
                            <input type="hidden" name="usu_id" value="{{$usuario->usu_id}}" />
                            @else    
                            <form role="form" class="form-horizontal form-validation" method="POST" action="{{url('central/usuario/store')}}">
                                @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                
                                        <div class="form-group {{ ($errors->first('usu_nome'))? 'has-error' : ''}}">
                                            <label class="col-sm-3 control-label">Nome</label>
                                            <div class="col-sm-9 append-icon">
                                                <input type="text" name="usu_nome" value="{{ old('usu_nome',isset($usuario->usu_nome) ? $usuario->usu_nome : null)}}" class="form-control form-white" minlength="3" placeholder="Digíte o nome"  id="firstName">
                                                @if($errors->first('usu_nome'))
                                                <div class="text-danger">{{$errors->first('usu_nome')}}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group {{ ($errors->first('usu_usuario'))? 'has-error' : ''}}">
                                            <label class="col-sm-3 control-label">Usuário</label>
                                            <div class="col-sm-9 append-icon">
                                                <input type="text" data-mask='AAAAAAAAAAAAAAAAAAAA'  data-mask-reverse="true" name="usu_usuario" value="{{ old('usu_usuario',isset($usuario->usu_usuario) ? $usuario->usu_usuario : null)}}" class="form-control form-white" minlength="4" placeholder="Nome do usuário" >
                                                @if($errors->first('usu_usuario'))
                                                <div class="text-danger">{{$errors->first('usu_usuario')}}</div>
                                                @endif
                                            </div>
                                        </div>
                                
                                        <div class="form-group {{ ($errors->first('usu_senha'))? 'has-error' : ''}}">
                                            <label class="col-sm-3 control-label">Senha</label>
                                            <div class="col-sm-9 append-icon">
                                                <input type="password" name="usu_senha" class="form-control form-white" placeholder="Digíte a senha" >
                                                @if($errors->first('usu_senha'))
                                                <div class="text-danger">{{$errors->first('usu_senha')}}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{ ($errors->first('usu_email'))? 'has-error' : ''}}">
                                            <label class="col-sm-3 control-label">E-mail</label>
                                            <div class="col-sm-9 append-icon">
                                                <input type="email" name="usu_email" value="{{ old('usu_email',isset($usuario->usu_email) ? $usuario->usu_email : null)}}" class="form-control form-white" placeholder="digíte o E-mail" minlength="3" >
                                                @if($errors->first('usu_email'))
                                                <div class="text-danger">{{$errors->first('usu_email')}}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group {{ ($errors->first('usu_idpermissao'))? 'has-error' : ''}}">
                                            <label class="col-sm-3 control-label">Permissões</label>
                                            <div class="col-sm-9 option-group">
                                                {{Form::select('usu_idpermissao', $permissoes, old('usu_idpermissao',isset($usuario->usu_idpermissao) ? $usuario->usu_idpermissao: null ), ['placeholder' => 'Escolha uma categoria...','class' => 'form-control form-white'])}}
                                                @if($errors->first('usu_idpermissao'))
                                                <div class="text-danger">{{$errors->first('usu_idpermissao')}}</div>
                                                @endif
                                            </div>
                                        </div>
                                
                                        <div class="row">
                                        <div class="col-sm-9 col-sm-offset-3">
                                          <div class="pull-right">
                                            <button type="submit" class="btn btn-embossed btn-primary m-r-20">Cadastrar</button>
                                            <a href="{{url('central/usuario')}}" class="cancel btn btn-embossed btn-default m-b-10 m-r-0">Cancelar</a>
                                          </div>
                                        </div>
                                      </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


