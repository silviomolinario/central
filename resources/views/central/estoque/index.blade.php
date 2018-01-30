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
    <div class="col-sm- col-sm-offset-0">
        <div class="left">
            <a href="{{url('central/estoque/filterproduct')}}" class="btn btn-embossed btn-default m-r-20"><i class="fa fa-arrow-left fa-2x"> Voltar</i></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 portlets">
        <div class="panel">
            <div class="panel-header clearfix">
                <h3><i class="fa fa-table"></i> <strong>Lojas</strong> Lista</h3>
                <div class="control-btn">
                    <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                </div>

            </div>
            <div class="panel-content pagination2" >
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                            <th>QTD. Loja</th>
                            <th>QTD. prateleira</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lojas AS $loja)
                        <tr>
                            <td>{{ $loja->loj_nome}}</td>
                            <td>{{ $loja->loj_telefone}}</td>
                            <td>{{ $loja->loj_email}}</td>
                            <td>{{ $loja->estoque->loja}}</td>
                            <td>{{ $loja->estoque->prateleira}}</td>
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
