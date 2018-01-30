@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-md-6">
        <div class="panel panel-default no-bd">
            <div class="panel-header bg-dark">
                <h2 class="panel-title">{{$titulo}}</h2>
            </div>
            <div class="panel-body bg-white">

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        @if(isset($loja)) 
                        <form role="form" class="form-horizontal form-validation" method="POST" action="{{url('central/loja/update')}}">
                            <input type="hidden" name="loj_id" value="{{$loja->loj_id}}" />
                            @else    
                            <form role="form" class="form-horizontal form-validation" method="POST" action="{{url('central/loja/store')}}">
                                @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <div class="form-group {{ ($errors->first('loj_nome'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Razão social</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="loj_nome" value="{{ old('loj_nome',isset($loja->loj_nome) ? $loja->loj_nome : null)}}" class="form-control form-white"  placeholder="Digite o nome"  id="firstName">
                                        @if($errors->first('loj_nome'))
                                        <div class="text-danger">{{$errors->first('loj_nome')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('loj_cnpj'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">CNPJ</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="loj_cnpj" data-mask="00.000.000/0000-00" value="{{ old('loj_cnpj',isset($loja->loj_cnpj) ? $loja->loj_cnpj : null)}}" class="form-control form-white"  placeholder="Digite o cnpj"  id="firstName">
                                        @if($errors->first('loj_cnpj'))
                                        <div class="text-danger">{{$errors->first('loj_cnpj')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('loj_urlapi'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">UrlApi</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="url" name="loj_urlapi" value="{{ old('loj_urlapi',isset($loja->loj_urlapi) ? $loja->loj_urlapi : null)}}" class="form-control form-white"  placeholder="Digite o UrlApi"  id="firstName">
                                        @if($errors->first('loj_urlapi'))
                                        <div class="text-danger">{{$errors->first('loj_urlapi')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('loj_inscricao_estadual'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Inscricao estadual</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="loj_inscricao_estadual" value="{{ old('loj_inscricao_estadual',isset($loja->loj_inscricao_estadual) ? $loja->loj_inscricao_estadual : null)}}" class="form-control form-white"  placeholder="Digite a inscrição"  id="firstName">
                                        @if($errors->first('loj_inscricao_estadual'))
                                        <div class="text-danger">{{$errors->first('loj_inscricao_estadual')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('loj_telefone'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Telefone</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="loj_telefone" data-mask="(00) 0000-0000" value="{{ old('loj_telefone',isset($loja->loj_telefone) ? $loja->loj_telefone : null)}}" class="form-control form-white"  placeholder="Digite o número"  id="firstName">
                                        @if($errors->first('loj_telefone'))
                                        <div class="text-danger">{{$errors->first('loj_telefone')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('loj_email'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">E-mail</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="email" name="loj_email" value="{{ old('loj_email',isset($loja->loj_email) ? $loja->loj_email : null)}}" class="form-control form-white"  placeholder="Digite o e-mail"  id="firstName">
                                        @if($errors->first('loj_email'))
                                        <div class="text-danger">{{$errors->first('loj_email')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('loj_endereco'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Endereco</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="loj_endereco" value="{{ old('loj_endereco',isset($loja->loj_endereco) ? $loja->loj_endereco : null)}}" class="form-control form-white"  placeholder="Digite o endereço"  id="firstName">
                                        @if($errors->first('loj_endereco'))
                                        <div class="text-danger">{{$errors->first('loj_endereco')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('loj_endereco_numero'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Numero</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="loj_endereco_numero" value="{{ old('loj_endereco_numero',isset($loja->loj_endereco_numero) ? $loja->loj_endereco_numero : null)}}" class="form-control form-white"  placeholder="Digite o numero"  id="firstName">
                                        @if($errors->first('loj_endereco_numero'))
                                        <div class="text-danger">{{$errors->first('loj_endereco_numero')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('loj_bairro'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Bairro</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="loj_bairro" value="{{ old('loj_bairro',isset($loja->loj_bairro) ? $loja->loj_bairro : null)}}" class="form-control form-white"  placeholder="Digite o bairro"  id="firstName">
                                        @if($errors->first('loj_bairro'))
                                        <div class="text-danger">{{$errors->first('loj_bairro')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('loj_cidade'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Cidade</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="loj_cidade" value="{{ old('loj_cidade',isset($loja->loj_cidade) ? $loja->loj_cidade : null)}}" class="form-control form-white"  placeholder="Digite a cidade"  id="firstName">
                                        @if($errors->first('loj_cidade'))
                                        <div class="text-danger">{{$errors->first('loj_cidade')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('loj_idestado'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Estado</label>
                                    <div class="col-sm-9 append-icon">
                                        {{Form::select('loj_idestado', $estados, old('loj_idestado',isset($loja->estados->id) ? $loja->estados->id: null ), ['placeholder' => 'Escolha o estado...','class' => 'form-control form-white','style' => 'width:100%'])}}
                                        @if($errors->first('loj_idestado'))
                                        <div class="text-danger">{{$errors->first('loj_idestado')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-embossed btn-primary m-r-20">Salvar</button>
                                            <a href="{{url('central/loja')}}" class="cancel btn btn-embossed btn-default m-b-10 m-r-0">Cancelar</a>
                                        </div>
                                    </div>
                                </div>

                                </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        @endsection