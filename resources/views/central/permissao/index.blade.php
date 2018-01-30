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
    <div class="col-md-8">
        <div class="panel">
            <form method="POST" action="{{url('central/configuracao/permissoes')}}">
                {{ csrf_field() }}
            <div class="panel-header clearfix">
                <h3><i class="fa fa-table"></i> <strong>Gestão e permissões</strong></h3>
                
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            @forelse($usuariosTipos AS $tipo)
                            <th>
                                {{$tipo->tip_nome}}
                            </th>
                            @empty
                            <th>Não há tipos de usuarios</th>
                            @endforelse
                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($grupos as $grupo)
                        <tr>
                            <td class="text-center" colspan="{{count($usuariosTipos) + 1}}">
                                <strong>{{$grupo->gru_nome}}</strong>
                            </td>
                        </tr>
                        @forelse($grupo->permissoes() as $permissao)
                        <tr>
                            <td>{{$permissao->perm_descricao}}</td>
                            @forelse($usuariosTipos AS $tipo)
                            <td>
                                @if($tipo->hasPermissao($permissao->perm_id))
                                <input type="checkbox" name="permissoes[{{$tipo->tip_id}}][{{$permissao->perm_id}}]" checked="checked" value="{{$permissao->perm_id}}">
                                @else
                                <input type="checkbox" name="permissoes[{{$tipo->tip_id}}][{{$permissao->perm_id}}]" value="{{$permissao->perm_id}}">
                                @endif
                            </td>
                            @empty
                            <td colspan="{{count($usuariosTipos) + 1}}">Não há Tipos de usuarios</td>
                            @endforelse
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{count($usuariosTipos) + 1}}">Não há Permissões</td>
                        </tr>
                        @endforelse
                        
                        @empty
                        <tr>
                            <td colspan="{{count($usuariosTipos) + 1}}">Não há grupos</td>
                        </tr>
                        @endforelse
                    </tbody>
                    
                </table>
            </div>
            <div class="panel-footer">
                <input class="btn btn-success" type="submit"  value="Salvar alterações">
            </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

