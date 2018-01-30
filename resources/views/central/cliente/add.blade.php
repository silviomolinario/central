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

                        @if(isset($cliente)) 
                        <form role="form" class="form-horizontal form-validation" method="POST" action="{{url('vendas/cliente/update')}}">
                            <input type="hidden" name="cli_id" value="{{$cliente->cli_id}}" />
                            @else    
                            <form role="form" class="form-horizontal form-validation" method="POST" action="{{url('vendas/cliente/store')}}">
                                @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <div class="form-group {{ ($errors->first('cli_nome'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Nome</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="cli_nome" value="{{ old('cli_nome',isset($cliente->cli_nome) ? $cliente->cli_nome : null)}}" class="form-control form-white" minlength="3" placeholder="Digite o nome"  id="firstName">
                                        @if($errors->first('cli_nome'))
                                        <div class="text-danger">{{$errors->first('cli_nome')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('cli_apelido'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Apelido</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text"  name="cli_apelido" value="{{ old('cli_apelido',isset($cliente->cli_apelido) ? $cliente->cli_apelido : null)}}" class="form-control form-white" minlength="4" placeholder="Digite o apelido" >
                                        @if($errors->first('cli_apelido'))
                                        <div class="text-danger">{{$errors->first('cli_apelido')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('cli_tipo_identificacao'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Tipo de identificacao</label>
                                    <div class="col-sm-9 option-group">
                                        {{Form::select('cli_tipo_identificacao', ['CPF' => 'CPF','CNPJ' => 'CNPJ'], old('cli_tipo_identificacao',isset($cliente->cli_tipo_identificacao) ? $cliente->cli_tipo_identificacao : null ), ['placeholder' => 'Escolha uma categoria...','class' => 'form-control form-white'])}}
                                        @if($errors->first('cli_tipo_identificacao'))
                                        <div class="text-danger">{{$errors->first('cli_tipo_identificacao')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('cli_identificacao'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Identificacao</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text"  name="cli_identificacao" value="{{ old('cli_identificacao',isset($cliente->cli_identificacao) ? $cliente->cli_identificacao : null)}}" class="form-control form-white" minlength="4" placeholder="Digite o número" >
                                        @if($errors->first('cli_identificacao'))
                                        <div class="text-danger">{{$errors->first('cli_identificacao')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('cli_inscricao_estadual'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Inscricao estadual</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="cli_inscricao_estadual" value="{{ old('cli_inscricao_estadual',isset($cliente->cli_inscricao_estadual) ? $cliente->cli_inscricao_estadual : null)}}" class="form-control form-white" minlength="4" placeholder="Digite o número" >
                                        @if($errors->first('cli_inscricao_estadual'))
                                        <div class="text-danger">{{$errors->first('cli_inscricao_estadual')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('cli_inscricao_municipal'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Inscricao municipal</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="cli_inscricao_municipal" value="{{ old('cli_inscricao_municipal',isset($cliente->cli_inscricao_municipal) ? $cliente->cli_inscricao_municipal : null)}}" class="form-control form-white" minlength="4" placeholder="Digite o número" >
                                        @if($errors->first('cli_inscricao_municipal'))
                                        <div class="text-danger">{{$errors->first('cli_inscricao_municipal')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('end_endereco'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Endereço</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="end_endereco" value="{{ old('end_endereco',isset($cliente->endereco->end_endereco) ? $cliente->endereco->end_endereco : null)}}" class="form-control form-white" minlength="4" placeholder="Digite o endereço" >
                                        @if($errors->first('end_endereco'))
                                        <div class="text-danger">{{$errors->first('end_endereco')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('end_numero'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Número do endereço</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="end_numero" value="{{ old('end_numero',isset($cliente->endereco->end_numero) ? $cliente->endereco->end_numero : null)}}" class="form-control form-white" minlength="4" placeholder="Digite o número" >
                                        @if($errors->first('end_numero'))
                                        <div class="text-danger">{{$errors->first('end_numero')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('end_complemento'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Complemento endereço</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="end_complemento" value="{{ old('end_complemento',isset($cliente->endereco->end_complemento) ? $cliente->endereco->end_complemento : null)}}" class="form-control form-white" minlength="4" placeholder="Digite o complemento" >
                                        @if($errors->first('end_complemento'))
                                        <div class="text-danger">{{$errors->first('end_complemento')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('end_bairro'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Bairro</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="end_bairro" value="{{ old('end_bairro',isset($cliente->endereco->end_bairro) ? $cliente->endereco->end_bairro : null)}}" class="form-control form-white" minlength="4" placeholder="Digite o bairro" >
                                        @if($errors->first('end_bairro'))
                                        <div class="text-danger">{{$errors->first('end_bairro')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('end_cep'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Cep</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="end_cep" value="{{ old('end_cep',isset($cliente->endereco->end_cep) ? $cliente->endereco->end_cep : null)}}" class="form-control form-white" minlength="4" placeholder="Digite o cep" >
                                        @if($errors->first('end_cep'))
                                        <div class="text-danger">{{$errors->first('end_cep')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('end_iduf'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">uf</label>
                                    <div class="col-sm-9 append-icon">
                                       {{Form::select('end_iduf', $estados, old('end_iduf',isset($cliente->endereco->end_iduf) ? $cliente->endereco->end_iduf: null ), ['placeholder' => 'Escolha uma categoria...','class' => 'form-control form-white'])}}
                                        @if($errors->first('end_iduf'))
                                        <div class="text-danger">{{$errors->first('end_iduf')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('end_cidade'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Cidade</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="end_cidade" value="{{ old('end_cidade',isset($cliente->endereco->end_cidade) ? $cliente->endereco->end_cidade : null)}}" class="form-control form-white" minlength="4" placeholder="Digite a cidade" >
                                        @if($errors->first('end_cidade'))
                                        <div class="text-danger">{{$errors->first('end_cidade')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('contato[FIXO]'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Numero telefone</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="contato[FIXO]" value="{{ old('contato.FIXO',isset($fixo) ? $fixo : null)}}" class="form-control form-white" minlength="4" placeholder="Digite o número" >
                                        @if($errors->first('contato_telefone'))
                                        <div class="text-danger">{{$errors->first('contato[FIXO]')}}</div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group {{ ($errors->first('contato[MOVEL]'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Numero telefone</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="contato[MOVEL]" value="{{ old('contato.MOVEL',isset($movel) ? $movel : null)}}" class="form-control form-white" minlength="4" placeholder="Digite o número" >
                                        @if($errors->first('contato_telefone'))
                                        <div class="text-danger">{{$errors->first('contato[MOVEL]')}}</div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group {{ ($errors->first('contato[FAX]'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Numero telefone</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="contato[FAX]" value="{{ old('contato.FAX',isset($fax) ? $fax : null)}}" class="form-control form-white" minlength="4" placeholder="Digite o fax" >
                                        @if($errors->first('contato_telefone'))
                                        <div class="text-danger">{{$errors->first('contato[FAX]')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('cli_nome_contato'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Nome para contato</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="cli_nome_contato" value="{{ old('cli_nome_contato',isset($cliente->cli_nome_contato) ? $cliente->cli_nome_contato : null)}}" class="form-control form-white" minlength="4" placeholder="Digite o nome" >
                                        @if($errors->first('cli_nome_contato'))
                                        <div class="text-danger">{{$errors->first('cli_nome_contato')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('contato_idoperadora'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">operadora celular</label>
                                    <div class="col-sm-9 append-icon">
                                       {{Form::select('contato_idoperadora', $operadoras, old('contato_idoperadora',isset($operadora) ? $operadora: null ), ['placeholder' => 'Escolha uma categoria...','class' => 'form-control form-white'])}}
                                        @if($errors->first('contato_idoperadora'))
                                        <div class="text-danger">{{$errors->first('contato_idoperadora')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('cli_endereco_site'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">endereco cite</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="cli_endereco_site" value="{{ old('cli_endereco_site',isset($cliente->cli_endereco_site) ? $cliente->cli_endereco_site : null)}}" class="form-control form-white" minlength="4" placeholder="Digite o site" >
                                        @if($errors->first('cli_endereco_site'))
                                        <div class="text-danger">{{$errors->first('cli_endereco_site')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->first('cli_observacoes'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">observacao</label>
                                    <div class="col-sm-9 append-icon">
                                        <textarea type="text" name="cli_observacoes" value="" class="form-control form-white" minlength="4" placeholder="Digite a observação" >{{ old('cli_observacoes',isset($cliente->cli_observacoes) ? $cliente->cli_observacoes : null)}}</textarea>
                                        @if($errors->first('cli_observacoes'))
                                        <div class="text-danger">{{$errors->first('cli_observacoes')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-embossed btn-primary m-r-20">Salvar</button>
                                            <a href="{{url('vendas/cliente')}}" class="cancel btn btn-embossed btn-default m-b-10 m-r-0">Cancelar</a>
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

