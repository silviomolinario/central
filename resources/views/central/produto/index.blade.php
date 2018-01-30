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
                    <a class="btn btn-primary" href="{{url('central/produto/create')}}" title="Cadastrar" >Cadastrar</a>
                </div>
                    
            </div>
            <div class="panel-content pagination2">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Codigo principal</th>
                            <th>Descrição</th>
                            <th>Categoria</th>
                            <th>Status</th>
                            <th>Preço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produtos AS $produto)
                        <tr>
                            <td>{{ $produto->pro_codigo_principal}}</td>
                            <td>{{ $produto->pro_nome}}</td>
                            <td>{{ $produto->categoria->cat_nome}}</td>
                            <td>
                                @if($produto->pro_status == 'ATIVO')
                                <span class="badge badge-success">{{ $produto->pro_status}}</span>
                                @elseif($produto->pro_status == 'INATIVO')
                                <span class="badge badge-warning">{{ $produto->pro_status}}</span>
                                @elseif($produto->pro_status == 'EXCLUIDO')
                                <span class="badge badge-danger">{{ $produto->pro_status}}</span>
                                @endif
                            </td>
                            <td>{{ reais($produto->pro_preco)}}</td>
                            <td>
                                <a href="{{ url('central/produto/edit/'.$produto->pro_id)}}" title="Editar"><i class="fa fa-2x fa-edit text-success"></i></a>
                                <a href="{{ url('central/produto/destroy/'.$produto->pro_id)}}" title="Excluir" onclick="return confirm('Você deseja realmente excluir este produto?')" ><i class="fa fa-2x fa-trash text-danger"></i></a>
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