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
                        <form role="form" class="form-horizontal form-validation" method="POST" action="{{url('central/caixa-mensagem/store')}}">
                            <input type="hidden" name="loj_id" value="" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div class="form-group {{ ($errors->first('men_idloja'))? 'has-error' : ''}}">
                                <label class="col-sm-3 control-label">Lojas</label>
                                <div class="col-sm-12 append-icon">
                                    {{Form::select('men_idloja', $lojas, old('men_idloja',isset($mensagem->estados->id) ? $mensagem->estados->id: null ), ['placeholder' => 'Escolha a loja...','class' => 'form-control form-white','style' => 'width:100%'])}}
                                    @if($errors->first('men_idloja'))
                                    <div class="text-danger">{{$errors->first('men_idloja')}}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ ($errors->first('men_titulo'))? 'has-error' : ''}}">
                                <label class="col-sm-3 control-label">Título</label>
                                <div class="col-sm-12 append-icon">
                                    <input type="text" name="men_titulo"  value="{{ old('men_titulo',isset($mensagem->men_titulo) ? $mensagem->men_titulo : null)}}" class="form-control form-white" placeholder="título"  >
                                    @if($errors->first('men_titulo'))
                                    <div class="text-danger">{{$errors->first('men_titulo')}}</div>
                                    @endif
                                </div>
                            </div>
                            <textarea name="men_descricao" class="summernote bg-white"></textarea>
                            <div class="row">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-embossed btn-primary m-r-20">Salvar</button>
                                        <a href="{{url('central/home')}}" class="cancel btn btn-embossed btn-default m-b-10 m-r-0">Cancelar</a>
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
