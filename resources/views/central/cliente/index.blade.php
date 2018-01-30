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

            </div>
            <div class="panel-content pagination2">
                <table class="table table-hover table-bordered table-dynamic">
                    <thead>
                        <tr>
                            <th>nome</th>
                            <th>Apelido</th>
                            <th>Identificação</th>
                            <th>nome do contato</th>
                            <th>Data Adicionado</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clientes AS $cliente)
                        <tr>
                            <td>{{ $cliente->cli_nome}}</td>
                            <td>{{ $cliente->cli_apelido}}</td>
                            <td>{{ $cliente->cli_identificacao}}</td>
                            <td>{{ $cliente->cli_nome_contato}}</td>
                            <td>{{ date('d/m/y ', strtotime($cliente->cli_data_adicionado))}}</td>
                            <td>{{ $cliente->cli_status}}</td>
                            <td>
                                <!--<a  title="Editar"><i class="fa fa-2x fa-edit text-success"></i></a>-->
                                @if($cliente->cli_status == 'ATIVO')
                                <a href="{{ url('central/cliente/block/'.$cliente->cli_id)}}" title="Bloquear" onclick="return confirm('Você deseja realmente bloquear este cliente?')" ><i class="fa fa-2x fa-ban"></i></a>
                                @elseif($cliente->cli_status == 'INATIVO')
                                <a href="{{url('central/cliente/unlock/'.$cliente->cli_id)}}" title="Desbloquear" onclick="return confirm('Você deseja realmente desbloquear este cliente?')" ><i class="fa fa-2x fa-key"></i></a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="7">Não há registros</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection