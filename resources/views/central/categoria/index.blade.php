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
                <h3><i class="fa fa-table"></i> <strong>Icone</strong> Lista</h3>
                <div class="control-btn">
                    <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{url('central/categoria/create')}}" title="Cadastrar" >Cadastrar</a>
                </div>

            </div>
            <div class="panel-content pagination2">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>nome</th>
                            <th>Data Adicionada</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categorias AS $categoria)
                        <tr>
                            <td>{{ $categoria->cat_id}}</td>
                            <td>{{ $categoria->cat_nome}}</td>
                            <td>{{ date('d/m/y ', strtotime($categoria->cat_data_adicionado))}}</td>
                            <td>
                                <a href="{{ url('central/categoria/edit/'.$categoria->cat_id)}}" title="Editar"><i class="fa fa-2x fa-edit text-success"></i></a>
                                <a href="{{ url('central/categoria/destroy/'.$categoria->cat_id)}}" title="Excluir" onclick="return confirm('Você deseja realmente excluir esta categoria?')" ><i class="fa fa-2x fa-trash text-danger"></i></a>

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