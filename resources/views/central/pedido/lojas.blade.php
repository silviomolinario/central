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

    <div class="col-md-12">
        <div class="panel panel-default no-bd">
            <div class="panel-header bg-dark">
                <h2 class="panel-title">Pedidos</h2>
            </div>
            <div class="panel-body bg-white">

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        <form role="form" class="form-vertical form-validation" method="GET" action="{{url('central/pedidos')}}">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group {{ ($errors->first('pro_nome'))? 'has-error' : ''}}">
                                        <label>Nome</label>
                                        {{Form::select('loja',$lojas,null,['class' => 'form-control select2'])}}
                                        @if($errors->first('pro_nome'))
                                        <div class="text-danger">{{$errors->first('pro_nome')}}</div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <div class="pull-right">
                                        <input type="submit" value="Buscar" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection


