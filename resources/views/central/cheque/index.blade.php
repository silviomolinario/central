@extends('layouts.app')

@section('content')
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
    @endforeach
</div>

<div class="pull-right">
    <a class="btn btn-primary" href="{{url('central/cheque/readercreate')}}" title="Cadastrar" >Cadastro com leitor</a>
    <a class="btn btn-danger" href="{{url('central/cheque/create')}}" title="Cadastrar" >Cadastro Manual</a>
</div>

<div class="row">
    <div class="col-md-12 portlets">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form role="form" class="form-vertical" method="POST" action="{{url('central/cheque')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="col-md-3">
                                <div class="input-group {{ ($errors->first('che_loja'))? 'has-error' : ''}}">
                                    <label>Loja</label>
                                    {{Form::select('che_loja', [null => ''] + $lojas, old('che_loja',isset($produto->che_loja) ? $produto->che_loja: null ), ['class' => 'form-control form-white'])}}
                                    @if($errors->first('che_loja'))
                                    <div class="text-danger">{{$errors->first('che_loja')}}</div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <button style="margin-top: 25px;" type="submit" class="btn btn-embossed btn-default">Pesquisar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 portlets">
        <div class="panel">
            <div class="panel-header clearfix">
                <h3><i class="fa fa-table"></i> <strong>{{$titulo}}</strong> Lista</h3>
                <div class="control-btn">
                    <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                </div>
            </div>
            <div class="panel-content pagination2">
                    <table class="table table-dynamic table-hover filter-head ">
                        <thead>
                            <tr>
                                <th>Loja</th>
                                <th>valor</th>
                                <th>data emissao</th>
                                <th>status</th>
                                <th class="no-filter">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cheques AS $cheque)
                            <tr>
                                <td>{{$cheque->loja->loj_nome}}</td>
                                <td>{{ Reais($cheque->che_valor)}}</td>
                                <td>{{ date('d/m/Y',strtotime($cheque->che_data_emissao))}}</td>
                                <td>
                                    @if($cheque->che_status == 'AGUARDANDO')
                                    <span class="badge badge-warning">{{ $cheque->che_status}}</span>
                                    @elseif($cheque->che_status == 'REPASSADO')
                                    <span class="badge badge-primary">{{ $cheque->che_status}}</span>
                                    @elseif($cheque->che_status == 'DEVOLVIDO')
                                    <span class="badge badge-info">{{ $cheque->che_status}}</span>
                                    @elseif($cheque->che_status == 'RECEBIDO')
                                    <span class="badge badge-success">{{ $cheque->che_status}}</span>
                                    @else
                                    <span class="badge badge-danger">{{ $cheque->che_status}}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('central/cheque/edit/'.$cheque->che_id)}}" title="Editar"><i class="fa fa-2x fa-edit text-success"></i></a>
                                    <a href="{{ url('central/cheque/destroy/'.$cheque->che_id)}}" title="Excluir" onclick="return confirm('Você deseja realmente excluir este cheque?')" ><i class="fa fa-2x fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Não há registros</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
@endsection
