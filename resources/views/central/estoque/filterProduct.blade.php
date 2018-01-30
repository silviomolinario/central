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
    <div class="col-md-6 portlets">
        <div class="panel">
            <div class="panel-header clearfix">
                <h3><i class="fa fa-table"></i> <strong>Icone</strong></h3>
                <div class="control-btn">
                    <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                </div>
                <form class="wizard" data-style="sky" data-nav="left" role="form" method="GET" action="{{url('central/estoque/stock')}}">
                    <div class="form-group {{ ($errors->first('produto'))? 'has-error' : ''}}">
                        <label>Produtos</label>
                        {{Form::select('produto', $produtos, old('produto',isset($produtos->produto) ? $produtos->produto: null ), ['placeholder' => 'Escolha o produto...','class' => 'form-control form-white'])}}
                        @if($errors->first('produto'))
                        <div class="text-danger">{{$errors->first('produto')}}</div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-embossed btn-primary m-r-20">Pesquisar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
