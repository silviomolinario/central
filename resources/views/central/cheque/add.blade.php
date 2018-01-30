@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-md-6">
        <div class="panel panel-default no-bd">
            <div class="panel-header bg-dark">
                <h2 class="panel-title">{{$titulo}}</h2>
            </div>

            @if(isset($cheque)) 
            <form role="form" class="form-vertical form-validation" method="POST" action="{{url('central/cheque/update')}}">
                <input type="hidden" name="che_id" value="{{$cheque->che_id}}" />
                @else    
                <form role="form" class="form-vertical form-validation" method="POST" action="{{url('central/cheque/store')}}">
                    @endif

                    <div class="panel-body bg-white">
                        <div class="row">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <fieldset>

                                <legend>Dados do cheque</legend>
                                
                                <div class="row">
                                    <div class="form-group col-sm-2 {{ ($errors->first('che_comp'))? 'has-error' : ''}}">
                                        <label class="">Comp*</label>
                                        <input type="text"  name="che_comp" data-mask='000' value="{{ old('che_comp',isset($cheque->che_comp) ? $cheque->che_comp : null)}}" class="form-control " placeholder="Digite o número" >
                                        @if($errors->first('che_comp'))
                                        <div class="text-danger">{{$errors->first('che_comp')}}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-sm-10 {{ ($errors->first('che_banco_codigo'))? 'has-error' : ''}}">
                                        <label class="">Banco*</label>
                                        {{Form::select('che_banco_codigo', $bancos ,old('che_banco_codigo',isset($cheque->banco->ban_codigo) ? $cheque->banco->ban_codigo : null ), ['class' => 'form-control select-search'])}}
                                        @if($errors->first('che_banco_codigo'))
                                        <div class="text-danger">{{$errors->first('che_banco_codigo')}}</div>
                                        @endif
                                    </div>
                                </div>
                                    
                                <div class="form-group col-sm-4 {{ ($errors->first('che_agencia'))? 'has-error' : ''}}">
                                    <label class="">Agencia*</label>
                                    <input type="text" name="che_agencia" data-mask='00000' data-mask-reverse="true" value="{{ old('che_agencia',isset($cheque->che_agencia) ? $cheque->che_agencia : null)}}" class="form-control " placeholder="Digite o número" >
                                    @if($errors->first('che_agencia'))
                                    <div class="text-danger">{{$errors->first('che_agencia')}}</div>
                                    @endif
                                </div>

                                <div class="form-group col-sm-4 {{ ($errors->first('che_conta'))? 'has-error' : ''}}">
                                    <label class="">Conta*</label>
                                    <input type="text" name="che_conta" data-mask='#' value="{{ old('che_conta',isset($cheque->che_conta) ? $cheque->che_conta : null)}}" class="form-control " placeholder="Digite o número"  id="firstName">
                                    @if($errors->first('che_conta'))
                                    <div class="text-danger">{{$errors->first('che_conta')}}</div>
                                    @endif
                                </div>
                                <div class="form-group col-sm-4 {{ ($errors->first('che_numero_cheque'))? 'has-error' : ''}}">
                                    <label class="">Número cheque*</label>
                                    <input type="text"  name="che_numero_cheque" data-mask='#' value="{{ old('che_numero_cheque',isset($cheque->che_numero_cheque) ? $cheque->che_numero_cheque : null)}}" class="form-control " placeholder="Digite o número"  id="firstName">
                                    @if($errors->first('che_numero_cheque'))
                                    <div class="text-danger">{{$errors->first('che_numero_cheque')}}</div>
                                    @endif
                                </div>
                                <div class="form-group col-sm-4 {{ ($errors->first('che_valor'))? 'has-error' : ''}}">
                                    <label class=" ">Valor (R$)*</label>
                                    <input type="text" name="che_valor" data-mask="000.000.000,00" data-mask-reverse="true" min="0"  value="{{ old('che_valor',isset($cheque->che_valor) ? $cheque->che_valor : null)}}" class="form-control " placeholder="digite o valor" >
                                    @if($errors->first('che_valor'))
                                    <div class="text-danger">{{$errors->first('che_valor')}}</div>
                                    @endif
                                </div>
                                <div class="form-group  col-sm-4 {{ ($errors->first('che_data_emissao'))? 'has-error' : ''}}">
                                    <label class="">Data emissão*</label>
                                    <input type="text" name="che_data_emissao" data-mask="00/00/0000" value="{{ old('che_data_emissao',isset($cheque->che_data_emissao) ? formatoBrazil($cheque->che_data_emissao) : null)}}" class="form-control  date-picker" placeholder="digite a data" >
                                    @if($errors->first('che_data_emissao'))
                                    <div class="text-danger">{{$errors->first('che_data_emissao')}}</div>
                                    @endif
                                </div>
                                <div class="form-group col-sm-4 {{ ($errors->first('che_data_vencimento'))? 'has-error' : ''}}">
                                    <label class="">Data vencimento*</label>
                                    <input type="text" name="che_data_vencimento" data-mask="00/00/0000" value="{{ old('che_data_vencimento',isset($cheque->che_data_vencimento) ? formatoBrazil($cheque->che_data_vencimento) : null)}}" class="form-control   date-picker" placeholder="digite a data" >
                                    @if($errors->first('che_data_vencimento'))
                                    <div class="text-danger">{{$errors->first('che_data_vencimento')}}</div>
                                    @endif
                                </div>

                            </fieldset>
                            <fieldset>
                                <legend>Dados do emitente</legend>

                                <div class="form-group col-sm-6 {{ ($errors->first('che_emitente'))? 'has-error' : ''}}">
                                    <label class="">Emitente*</label>
                                    <input type="text"  name="che_emitente" value="{{ old('che_emitente',isset($cheque->che_emitente) ? $cheque->che_emitente : null)}}" class="form-control  calendario" placeholder="Digite o emitente"  id="firstName">
                                    @if($errors->first('che_emitente'))
                                    <div class="text-danger">{{$errors->first('che_emitente')}}</div>
                                    @endif
                                </div>
                                <div class="form-group col-sm-6 {{ ($errors->first('che_cnpj_cpf'))? 'has-error' : ''}}">
                                    <label class="">CNPJ/CPF*</label>
                                    <input type="text"  name="che_cnpj_cpf" value="{{ old('che_cnpj_cpf',isset($cheque->che_cnpj_cpf) ? $cheque->che_cnpj_cpf : null)}}" class="form-control " placeholder="Digite o número" >
                                    @if($errors->first('che_cnpj_cpf'))
                                    <div class="text-danger">{{$errors->first('che_cnpj_cpf')}}</div>
                                    @endif
                                </div>

                                <div class="form-group  col-sm-6 {{ ($errors->first('che_telefone'))? 'has-error' : ''}}">
                                    <label class="">Telefone*</label>
                                    <input type="text" data-mask="(00)00000-0000" name="che_telefone" value="{{ old('che_telefone',isset($cheque->che_telefone) ? $cheque->che_telefone : null)}}" class="form-control " placeholder="digite o numero" >
                                    @if($errors->first('che_telefone'))
                                    <div class="text-danger">{{$errors->first('che_telefone')}}</div>
                                    @endif
                                </div>

                                <div class="form-group col-sm-12 {{ ($errors->first('che_observacao'))? 'has-error' : ''}}">
                                    <label class="">Observacão</label>
                                    <textarea rows="4"  name="che_observacao" value="" class="form-control " placeholder="Digite a observação" >{{ old('che_observacao',isset($cheque->che_observacao) ? $cheque->che_observacao : null)}}</textarea>
                                    @if($errors->first('che_observacao'))
                                    <div class="text-danger">{{$errors->first('che_observacao')}}</div>
                                    @endif
                                </div>
                            </fieldset>
                            
                            <fieldset>
                                <legend>Dados da Loja</legend>
                                
                                <div class="form-group col-sm-10 {{ ($errors->first('che_loja'))? 'has-error' : ''}}">
                                    <label class="">Loja*</label>
                                    {{Form::select('che_loja', $lojas ,old('che_loja',isset($cheque->che_loja) ? $cheque->che_loja : null ), ['placeholder' => 'Escolha uma loja...','class' => 'form-control '])}}
                                    @if($errors->first('che_loja'))
                                    <div class="text-danger">{{$errors->first('che_loja')}}</div>
                                    @endif
                                </div>
                                
                            </fieldset>
                            
                            <fieldset>
                                <legend>Situação</legend>
                                
                                <div class="form-group col-sm-10 {{ ($errors->first('che_status'))? 'has-error' : ''}}">
                                    <label class="">Situação*</label>
                                    {{Form::select('che_status', $situacoes ,old('che_status',isset($cheque->che_status) ? $cheque->che_status : null ), ['class' => 'form-control','id' => 'situcaoSelect'])}}
                                    @if($errors->first('che_status'))
                                    <div class="text-danger">{{$errors->first('che_status')}}</div>
                                    @endif
                                </div>
                                
                                <div id='divRepassado' style="display:none;" class="form-group col-sm-10 {{ ($errors->first('che_cliente_repassado'))? 'has-error' : ''}}">
                                    <label class="">Cliente Repassado*</label>
                                    {{Form::select('che_cliente_repassado', $clientes ,old('che_cliente_repassado',isset($cheque->che_cliente_repassado) ? $cheque->che_cliente_repassado : null ), ['class' => 'form-control '])}}
                                    @if($errors->first('che_cliente_repassado'))
                                    <div class="text-danger">{{$errors->first('che_cliente_repassado')}}</div>
                                    @endif
                                </div>
                                
                            </fieldset>
                        </div>
                    </div>
                    <div class="panel-footer clearfix">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-embossed btn-success">Salvar</button>
                            <a href="{{url('central/cheque')}}" class="cancel btn btn-embossed btn-default">Cancelar</a>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function(){
        
       if($('#situcaoSelect').val() == 'REPASSADO'){
           $('#divRepassado').show();
       } else {
           $('#divRepassado').hide();
       }
        
       $('#situcaoSelect').change(function(){
           if($(this).val() == 'REPASSADO'){
               $('#divRepassado').show();
           } else {
               $('#divRepassado').hide();
           }
       }) 
    });
</script>
@endpush