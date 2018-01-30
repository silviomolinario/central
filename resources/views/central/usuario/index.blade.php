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
                    <a class="btn btn-primary" href="{{url('central/usuario/create')}}" title="Cadastrar" >Cadastrar</a>
                </div>
                    
            </div>
            <div class="panel-content pagination2">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuário</th>
                            <th>Status</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Data Adicionada</th>
                            <th>Pemissão</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuarios AS $usuario)
                        <tr>
                            <td>{{ $usuario->usu_id}}</td>
                            <td>{{ $usuario->usu_usuario}}</td>
                            <td>{{ $usuario->usu_status}}</td>
                            <td>{{ $usuario->usu_nome}}</td>
                            <td>{{ $usuario->usu_email}}</td>
                            <td>{{ date('d/m/y ', strtotime($usuario->usu_data_adicionada))}}</td>
                            <td>{{ $usuario->tipo->tip_nome}}</td>
                            <td>
                                <a href="{{ url('central/usuario/edit/'.$usuario->usu_id)}}" title="Editar"><i class="fa fa-2x fa-edit text-success"></i></a>
                                @if ($usuario->usu_status == 'ATIVO')
                                <a href="{{ url('central/usuario/block/'.$usuario->usu_id)}}" title="Bloquear" onclick="return confirm('Você deseja realmente bloquear este usuário?')"><i class="fa fa-2x fa-ban"></i></a>
                                @elseif ($usuario->usu_status == 'BLOQUEADO')
                                <a href="{{ url('central/usuario/unlock/'.$usuario->usu_id)}}" title="Desbloquear" onclick="return confirm('Você deseja realmente desbloquear este usuário?')"><i class="fa fa-2x fa-key"></i></a>
                                @endif
                                <a href="{{ url('central/usuario/destroy/'.$usuario->usu_id)}}" title="Excluir" onclick="return confirm('Você deseja realmente excluir este usuário?')" ><i class="fa fa-2x fa-trash text-danger"></i></a>
                                
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