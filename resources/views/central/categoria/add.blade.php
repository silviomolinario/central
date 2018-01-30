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

    <div class="col-md-6">
        <div class="panel panel-default no-bd">
            <div class="panel-header bg-dark">
                <h2 class="panel-title">{{$titulo}}</h2>
            </div>
            <div class="panel-body bg-white">

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        @if(isset($categoria)) 
                        <form role="form" class="form-horizontal form-validation" method="POST" action="{{url('central/categoria/update')}}">
                            <input type="hidden" name="cat_id" value="{{$categoria->cat_id}}" />
                            @else    
                            <form role="form" class="form-horizontal form-validation" method="POST" action="{{url('central/categoria/store')}}">
                                @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <div class="form-group {{ ($errors->first('cat_nome'))? 'has-error' : ''}}">
                                    <label class="col-sm-3 control-label">Nome</label>
                                    <div class="col-sm-9 append-icon">
                                        <input type="text" name="cat_nome" value="{{ old('cat_nome',isset($categoria->cat_nome) ? $categoria->cat_nome : null)}}" class="form-control form-white" minlength="4" placeholder="Digite o nome" >
                                        @if($errors->first('cat_nome'))
                                        <div class="text-danger">{{$errors->first('cat_nome')}}</div>
                                        @endif

                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-embossed btn-primary m-r-20">Cadastrar</button>
                                            <a href="{{url('central/categoria')}}" class="cancel btn btn-embossed btn-default m-b-10 m-r-0">Cancelar</a>
                                        </div>
                                    </div>
                                </div>

                                </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        @endsection

