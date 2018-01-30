@extends('layouts.app')

@section('content')

<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
    @endforeach
</div>

<div class="row">

    <div class="col-md-7">
        <div class="panel panel-default no-bd">
            <div class="panel-header bg-dark">
                <h2 class="panel-title">{{$titulo}}</h2>
            </div>
            <div class="panel-body bg-white">

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        @if(isset($produto)) 
                        <form role="form" class="form-vertical form-validation" method="POST" action="{{url('central/produto/update')}}">
                            <input type="hidden" name="pro_id" value="{{$produto->pro_id}}" />
                            @else    
                            <form role="form" class="form-vertical form-validation" method="POST" action="{{url('central/produto/store')}}">
                                @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group {{ ($errors->first('pro_nome'))? 'has-error' : ''}}">
                                        <label>Descrição</label>
                                        <input type="text" name="pro_nome" value="{{ old('pro_nome',isset($produto->pro_nome) ? $produto->pro_nome : null)}}" class="form-control form-white" placeholder="Digite o nome" >
                                        @if($errors->first('pro_nome'))
                                        <div class="text-danger">{{$errors->first('pro_nome')}}</div>
                                        @endif
                                    </div>
                                </div>
                                </div>

                                <div class="row">
                                <div class="col-sm-6 ">
                                    @if(!isset($produto))
                                    <div class="form-group{{ ($errors->first('pro_codigo_principal'))? 'has-error' : ''}}">
                                        <label class="">Código Produto</label>
                                        <input type="text"  data-mask-reverse="true" min="0" name="pro_codigo_principal" value="{{ old('pro_codigo_principal',isset($produto->pro_codigo_principal) ? $produto->pro_codigo_principal : null)}}" class="form-control form-white" placeholder="Digite o código"  id="firstName">
                                        @if($errors->first('pro_codigo_principal'))
                                        <div class="text-danger">{{$errors->first('pro_codigo_principal')}}</div>
                                        @endif
                                    </div>
                                    @else
                                    <div class="form-group{{ ($errors->first('pro_codigo_principal'))? 'has-error' : ''}}">
                                        <label class="">Código Produto</label>
                                        <div class="form-control">{{$produto->pro_codigo_principal}}</div>
                                        @if($errors->first('pro_codigo_principal'))
                                        <div class="text-danger">{{$errors->first('pro_codigo_principal')}}</div>
                                        @endif
                                    </div>
                                    @endif
                                </div>

                                <div class="col-sm-6 ">
                                    @if(!isset($produto))
                                    <div class="form-group {{ ($errors->first('pro_codigo_secundario'))? 'has-error' : ''}}">
                                        <label>Código Cor (Caso não possua deixar em branco)</label>
                                        <input type="text"  data-mask-reverse="true" min="0" name="pro_codigo_secundario" value="{{ old('pro_codigo_secundario',isset($produto->pro_codigo_secundario) ? $produto->pro_codigo_secundario : null)}}" class="form-control form-white" placeholder="Digite o código"  id="firstName">
                                        @if($errors->first('pro_codigo_secundario'))
                                        <div class="text-danger">{{$errors->first('pro_codigo_secundario')}}</div>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                </div>

                                <div class="row">
                                <div class="col-sm-4 ">
                                    @if(!isset($produto))
                                    <div class="form-group {{ ($errors->first('pro_codigo_fabricante'))? 'has-error' : ''}}">
                                        <label>Código fabricante</label>
                                        <input type="text"  data-mask-reverse="true" min="0" name="pro_codigo_fabricante" value="{{ old('pro_codigo_fabricante',isset($produto->pro_codigo_fabricante) ? $produto->pro_codigo_fabricante : null)}}" class="form-control form-white" placeholder="Digite o código"  id="firstName">
                                        @if($errors->first('pro_codigo_fabricante'))
                                        <div class="text-danger">{{$errors->first('pro_codigo_fabricante')}}</div>
                                        @endif
                                    </div>
                                    @else
                                    <div class="form-group {{ ($errors->first('pro_codigo_fabricante'))? 'has-error' : ''}}">
                                        <label>Código fabricante</label>
                                        <input type="text"  data-mask-reverse="true" min="0" name="pro_codigo_fabricante" value="{{ old('pro_codigo_fabricante',isset($produto->pro_codigo_fabricante) ? $produto->pro_codigo_fabricante : null)}}" class="form-control form-white" placeholder="Digite o código"  id="firstName">
                                        @if($errors->first('pro_codigo_fabricante'))
                                        <div class="text-danger">{{$errors->first('pro_codigo_fabricante')}}</div>
                                        @endif
                                    </div>
                                    @endif
                                </div>

                                <div class="col-sm-4 ">
                                    @if(!isset($produto))
                                    <div class="form-group {{ ($errors->first('pro_codigo_barra'))? 'has-error' : ''}}">
                                        <label>Código de barra</label>
                                        <input type="text"  data-mask-reverse="true" min="0" name="pro_codigo_barra" value="{{ old('pro_codigo_barra',isset($produto->pro_codigo_barra) ? $produto->pro_codigo_barra : null)}}" class="form-control form-white" placeholder="Digite o código" >
                                        @if($errors->first('pro_codigo_barra'))
                                        <div class="text-danger">{{$errors->first('pro_codigo_barra')}}</div>
                                        @endif
                                    </div>
                                    @else
                                    <div class="form-group {{ ($errors->first('pro_codigo_barra'))? 'has-error' : ''}}">
                                        <label>Código de barra</label>
                                        <input type="text"  data-mask-reverse="true" min="0" name="pro_codigo_barra" value="{{ old('pro_codigo_barra',isset($produto->pro_codigo_barra) ? $produto->pro_codigo_barra : null)}}" class="form-control form-white" placeholder="Digite o código" >
                                        @if($errors->first('pro_codigo_barra'))
                                        <div class="text-danger">{{$errors->first('pro_codigo_barra')}}</div>
                                        @endif
                                    </div>
                                    @endif
                                </div>

                                <div class="col-sm-4 ">
                                    @if(!isset($produto))
                                    <div class="form-group {{ ($errors->first('pro_cfop'))? 'has-error' : ''}}">
                                        <label>CFOP</label>
                                        <input type="text" name="pro_cfop" min="0" value="{{ old('pro_cfop',isset($produto->pro_cfop) ? $produto->pro_cfop : null)}}" class="form-control form-white" placeholder="digite o CFOP" >
                                        @if($errors->first('pro_cfop'))
                                        <div class="text-danger">{{$errors->first('pro_cfop')}}</div>
                                        @endif
                                    </div>
                                    @else
                                    <div class="form-group {{ ($errors->first('pro_cfop'))? 'has-error' : ''}}">
                                        <label>CFOP</label>
                                        <input type="text" name="pro_cfop" min="0" value="{{ old('pro_cfop',isset($produto->pro_cfop) ? $produto->pro_cfop : null)}}" class="form-control form-white" placeholder="digite o CFOP" >
                                        @if($errors->first('pro_cfop'))
                                        <div class="text-danger">{{$errors->first('pro_cfop')}}</div>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                </div>

                                <div class="row">
                                <div class="col-sm-6 ">
                                    <div class="form-group {{ ($errors->first('pro_idcategoria'))? 'has-error' : ''}}">
                                        <label>Selecione Categoria</label>
                                        {{Form::select('pro_idcategoria', $categorias, old('pro_idcategoria',isset($produto->pro_idcategoria) ? $produto->pro_idcategoria: null ), ['placeholder' => 'Escolha uma categoria...','class' => 'form-control form-white'])}}
                                        @if($errors->first('pro_idcategoria'))
                                        <div class="text-danger">{{$errors->first('pro_idcategoria')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6 ">
                                    <div class="form-group {{ ($errors->first('pro_medida'))? 'has-error' : ''}}">
                                        <label>Selecione a medida</label>
                                        {{Form::select('pro_medida', ['QUILO' => 'QUILO', 'METRO' => 'METRO', 'UNIDADE' => 'UNIDADE'], old('pro_medida',isset($produto->pro_medida) ? $produto->pro_medida: null ), ['placeholder' => 'Escolha uma medida...','class' => 'form-control form-white'])}}
                                        @if($errors->first('pro_medida'))
                                        <div class="text-danger">{{$errors->first('pro_medida')}}</div>
                                        @endif
                                    </div>
                                </div>
                                </div>

                                <div class="row">
                                <div class="col-sm-6 ">
                                    <div class="form-group {{ ($errors->first('pro_prateleira'))? 'has-error' : ''}}">
                                        <label>Controle de  Prateleira</label>
                                        {{Form::select('pro_prateleira', ['SIM' => 'SIM','NAO' => 'NÃO'], old('pro_prateleira',isset($produto->pro_prateleira) ? $produto->pro_prateleira: null ), ['placeholder' => 'Escolha uma categoria...','class' => 'form-control form-white'])}}
                                        @if($errors->first('pro_prateleira'))
                                        <div class="text-danger">{{$errors->first('pro_prateleira')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6 ">
                                    <div class="form-group {{ ($errors->first('pro_preco'))? 'has-error' : ''}}">
                                        <label>Preço</label>
                                        <input type="text" data-mask="000.000.000,00" data-mask-reverse="true" name="pro_preco" min="0" value="{{ old('pro_preco',isset($produto->pro_preco) ? $produto->pro_preco : null)}}" class="form-control form-white" placeholder="digite o preço" >
                                        @if($errors->first('pro_preco'))
                                        <div class="text-danger">{{$errors->first('pro_preco')}}</div>
                                        @endif
                                    </div>
                                </div>
                                </div>

                                @if(isset($produto))
                                <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group {{ ($errors->first('pro_status'))? 'has-error' : ''}}">
                                        <label>Status</label>
                                        {{Form::select('pro_status', ['ATIVO' => 'ATIVO','INATIVO' => 'INATIVO'], old('pro_status',isset($produto->pro_status) ? $produto->pro_status : null ), ['placeholder' => 'Escolha uma categoria...','class' => 'form-control form-white'])}}
                                        @if($errors->first('pro_status'))
                                        <div class="text-danger">{{$errors->first('pro_status')}}</div>
                                        @endif
                                    </div>
                                </div>
                                </div>
                                @endif

                                <div class="row">
                                <div class="col-sm-12 ">
                                    <div class="form-group {{ ($errors->first('pro_descricao'))? 'has-error' : ''}}">
                                        <label>Observação</label>
                                        <textarea rows="4"  name="pro_descricao" value="" class="form-control form-white" placeholder="Digite descrição" >{{ old('pro_descricao',isset($produto->pro_descricao) ? $produto->pro_descricao : null)}}</textarea>
                                        @if($errors->first('pro_descricao'))
                                        <div class="text-danger">{{$errors->first('pro_descricao')}}</div>
                                        @endif
                                    </div>
                                </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-embossed btn-primary m-r-20">Cadastrar</button>
                                            <a href="{{url('central/produto')}}" class="cancel btn btn-embossed btn-default m-b-10 m-r-0">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @if(isset($derivados))
    <div class="col-md-5">
        <div class="panel bg-blue">
            <div class="panel-header bg-green">
                <h2 class="panel-title">Produtos derivados</h2>
            </div>
            <div class="panel-body bg-white">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Código</th>
                            <th>Valor</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($derivados AS $derivado)
                        <tr>
                            <td>{{$derivado->pro_nome}}</td>
                            <td>{{$derivado->pro_codigo_principal}}</td>
                            <td>{{reais($derivado->pro_preco)}}</td>
                            <td>
                                <a class="btn btn-sm btn-default" href="{{url('central/produto/edit/'.$derivado->pro_id)}}">ACESSAR</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Não há derivações
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="panel-footer clearfix">
                <div class="pull-right">
                    <a href="{{url('central/produto/createderivado/'.$produto->pro_id)}}" class="btn btn-success">Adicionar Derivativo</a>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    @if(isset($derivante))
    <div class="col-md-5">
        <div class="panel bg-blue">
            <div class="panel-header bg-red">
                <h2 class="panel-title">Produto Principal</h2>
            </div>
            <div class="panel-body bg-white">
                <table class="table table-bordered">
                    <tr>
                        <td>Descrição</td>
                        <td>{{$derivante->pro_nome}}</td>
                    </tr>
                    <tr>
                        <td>Código</td>
                        <td>{{$derivante->pro_codigo_principal}}</td>
                    </tr>
                    <tr>
                        <td>Valor</td>
                        <td>{{ reais($derivante->pro_preco)}}</td>
                    </tr>
                    <tr>
                        <td>Acessar</td>
                        <td><a class="btn btn-sm btn-default" href="{{url('central/produto/edit/'.$derivante->pro_id)}}">ACESSAR</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    @endif
    
</div>
@endsection


