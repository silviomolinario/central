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
    <div class="col-md-12 portlets">
        <div class="panel">
            <div class="panel-header clearfix">
                <h3><i class="fa fa-table"></i> <strong>{{$titulo}}</strong> Lista</h3>
                <div class="control-btn">
                    <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{url('central/loja/create')}}" title="Cadastrar" >Cadastrar</a>
                </div>

            </div>
            <div class="panel-content pagination2">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>nome</th>
                            <th>CNPJ</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                            <th>Data Adicionada</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lojas AS $loja)
                        <tr>
                            <td>{{ $loja->loj_codigo_interno}}</td>
                            <td>{{ $loja->loj_nome}}</td>
                            <td>{{ $loja->loj_cnpj}}</td>
                            <td>{{ $loja->loj_telefone}}</td>
                            <td>{{ $loja->loj_email}}</td>
                            <td>{{ date('d/m/y ', strtotime($loja->loj_data_adicionado))}}</td>
                            <td>{{ $loja->loj_status}}</td>
                            <td>
                                <a href="{{ url('central/loja/edit/'.$loja->loj_id)}}" title="Editar"><i class="fa fa-2x fa-edit text-success"></i></a>
                                <a href="{{ url('central/loja/destroy/'.$loja->loj_id)}}" title="Excluir" onclick="return confirm('Você deseja realmente excluir esta loja?')" ><i class="fa fa-2x fa-trash text-danger"></i></a>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">Não há registros</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection