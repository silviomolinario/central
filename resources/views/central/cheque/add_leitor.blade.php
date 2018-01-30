@extends('layouts.app')

@section('content')

<div class="row" id="app">

    <div class="col-md-6">
        <div class="panel panel-default no-bd">
            <div class="panel-header bg-dark">
                <h2 class="panel-title">{{$titulo}}</h2>
            </div>

            <form role="form" onsubmit="return false" class="form-vertical" v-on:keyup.enter="verify">
                <div class="panel-body bg-white">
                    <div class="row">


                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <fieldset>
                            <div class="form-group col-sm-12 {{ ($errors->first('cmc7'))? 'has-error' : ''}}">
                                <label class="">CMC7</label>
                                <the-mask autocomplete="off" class="form-control" v-model="cmc7Input" id="cmc7Input" name="cmc7" :mask="['########    ##########    ############']" />
                                @if($errors->first('cmc7'))
                                <div class="text-danger">{{$errors->first('cmc7')}}</div>
                                @endif
                            </div>
                        </fieldset>

                        <div id="divContent" style="display:none;">
                            <fieldset>
                                <legend>Dados do cheque</legend>

                                <div class="form-group col-sm-2">
                                    <label class="">Comp*</label>
                                    <input v-model="check.che_comp" type="text" class="form-control " placeholder="Digite o número" >
                                </div>
                                <div class="form-group col-sm-10">
                                    <label class="">Banco*</label>
                                    <select class="form-control" v-model="check.che_banco_codigo">
                                        <option v-for="bank in banks" :value="bank.ban_codigo">@{{ bank.ban_nome }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="">Agencia*</label>
                                    <input v-model="check.che_agencia" type="text" class="form-control " placeholder="Digite o número" >
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="">Conta*</label>
                                    <input v-model="check.che_conta" type="text" name="che_conta"  class="form-control" placeholder="Digite o número" >
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="">Número cheque*</label>
                                    <input v-model="check.che_numero_cheque" type="text"  class="form-control" placeholder="Digite o número">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label  class=" ">Valor (R$)*</label>
                                    <money id="valor" v-model="check.che_valor" v-bind="money" class="form-control"  placeholder="digite o valor"></money>
                                </div>
                                <div class="form-group  col-sm-4">
                                    <label class="">Data emissão*</label>
                                    <input  type="text" id="dataEmissao" class="form-control  date-picker">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="">Data vencimento*</label>
                                    <input  type="text" id="dataVencimento" class="form-control   date-picker">
                                </div>

                            </fieldset>
                            <fieldset>
                                <legend>Dados do emitente</legend>

                                <div class="form-group col-sm-6">
                                    <label class="">Emitente*</label>
                                    <input  type="text"  v-model="check.che_emitente" class="form-control  calendario" placeholder="Digite o emitente" >
                                </div>
                                <div class="form-group col-sm-6 {{ ($errors->first('che_cnpj_cpf'))? 'has-error' : ''}}">
                                    <label class="">CNPJ/CPF*</label>
                                    <the-mask v-model="check.che_cnpj_cpf" class="form-control" :mask="['###.###.###-##']" />
                                </div>

                                <div class="form-group  col-sm-6">
                                    <label class="">Telefone*</label>
                                    <the-mask v-model="check.che_telefone" class="form-control" :mask="['(##) #####-####']" />
                                </div>

                                <div class="form-group col-sm-12">
                                    <label class="">Observacão</label>
                                    <textarea  rows="4"  v-model="check.che_observacao" value="" class="form-control " placeholder="Digite a observação" ></textarea>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>Dados da Loja</legend>

                                <div class="form-group col-sm-12">
                                    <label class="">Loja*</label>
                                    <select class="form-control" v-model="check.che_loja">
                                        <option v-for="loja in lojas" :value="loja.loj_id">@{{ loja.loj_nome }}</option>
                                    </select>
                                </div>
                            </fieldset>
                            
                            <fieldset>
                                <legend>Situação</legend>
                                
                                <div class="form-group col-sm-10">
                                    <label class="">Situação*</label>
                                    <select id="situcaoSelect" class="form-control" v-model="check.che_status">
                                        <option v-for="sta in status" :value="sta">@{{ sta }}</option>
                                    </select>
                                </div>
                                
                                <div id='divRepassado' style="display:none;" class="form-group col-sm-10 {{ ($errors->first('che_cliente_repassado'))? 'has-error' : ''}}">
                                    <label class="">Cliente Repassado*</label>
                                    <select class="form-control" v-model="check.che_cliente_repassado">
                                        <option v-for="cliente in clientes" :value="cliente.cli_id">@{{ cliente.cli_nome }}</option>
                                    </select>
                                </div>
                                
                            </fieldset>

                            <div class="pull-right">
                                <div class="form-group">
                                    <a style="margin-top: 15px;" v-on:click="save()" class="btn btn-success">Salvar</a>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@push('scripts')

<script src="https://unpkg.com/vue"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.4"></script>
<script src="{{ URL::asset('js/vue-the-mask.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/v-money.js') }}" type="text/javascript"></script>

<script>
                var base_url = window.location.origin + '/';

                $(function () {
                    $("#cmc7Input").focus();
                })
                
                $(function () {

                    if ($('#situcaoSelect').val() == 'REPASSADO') {
                        
                        $('#divRepassado').show();
                    } else {
                        $('#divRepassado').hide();
                    }

                    $('#situcaoSelect').change(function () {
                        if ($(this).val() == 'REPASSADO') {
                            $('#divRepassado').show();
                        } else {
                            $('#divRepassado').hide();
                        }
                    })
                });


                new Vue({
                    el: '#app',
                    data: {
                        banks: [],
                        cmc7Input: null,
                        lojas: [],
                        clientes: [],
                        status: [
                            'AGUARDANDO',
                            'REPASSADO',
                            'DEVOLVIDO', 
                            'RECEBIDO',  
                            'EXCLUIDO'
                        ],
                        check: {
                            che_banco_codigo: null,
                            che_agencia: null,
                            che_conta: null,
                            che_numero_cheque: null,
                            che_comp: null,
                            che_emitente: null,
                            che_cnpj_cpf: null,
                            che_telefone: null,
                            che_data_emissao: null,
                            che_data_vencimento: null,
                            che_valor: null,
                            che_observacao: null,
                            che_loja: null,
                            che_status : null,
                            che_cliente_repassado : null
                        },
                        money: {
                            decimal: ',',
                            thousands: '.',
                            prefix: 'R$ ',
                            precision: 2,
                            masked: false
                        }
                    },
                    created: function () {
                        this.getBanks();
                        this.getLojas();
                        this.getCliente();
                    },
                    methods: {
                        getBanks: function () {
                            this.$http.get(base_url + 'central/cheque/getAllBanks').then(function(response){
                                this.banks = response.body;
                            });
                        },
                        getCliente: function (){
                            this.$http.get(base_url + 'central/cliente/getall').then(function(response) {
                                this.clientes = response.body;
                            });
                        },
                        getLojas: function () {
                            this.$http.get(base_url + 'central/loja/getAllLojas').then(function(response) {
                                this.lojas = response.body;
                            });
                        },
                        verify: function () {

                            var cmc7 = this.cmc7Input.replace(/[^0-9]/g, '');

                            this.check.che_banco_codigo = cmc7.substring(0, 3);
                            this.check.che_agencia = cmc7.substring(3, 7);
                            this.check.che_comp = cmc7.substring(8, 11);
                            this.check.che_numero_cheque = cmc7.substring(11, 17);
                            this.check.che_conta = cmc7.substring(23, 29);

                            $(function () {
                                $("#divContent").slideDown();
                                $("#valor").focus();
                            })
                        },
                        save: function () {
                            this.check.che_data_emissao = $('#dataEmissao').val()
                            this.check.che_data_vencimento = $('#dataVencimento').val()

                            this.$http.post(base_url + 'central/cheque/readerstore', this.check).then(function(response) {
                                var response = response.body;

                                if (response.erros) {
                                    notificacao(response.erros, 'danger');
                                } else {
                                    notificacao("Cheque Cadastrado com sucesso");
                                    
                                    $('#dataEmissao').val("")
                                    $('#dataVencimento').val("")
                                    
                                    this.clear();
                                }
                            });

                        },
                        clear: function () {

                            this.check.che_banco_codigo = null;
                            this.check.che_agencia = null;
                            this.check.che_conta = null;
                            this.check.che_numero_cheque = null;
                            this.check.che_comp = null;
                            this.check.che_emitente = null;
                            this.check.che_cnpj_cpf = null;
                            this.check.che_telefone = null;
                            this.check.che_data_emissao = null;
                            this.check.che_data_vencimento = null;
                            this.check.che_valor = null;
                            this.check.che_observacao = null;
                            this.check.che_loja = null;
                            this.check.che_status = null;
                            this.check.che_cliente_repassado = null;

                            $("#cmc7Input").val("");
                            $("#cmc7Input").focus();
                            $("#divContent").slideUp();
                        }

                    }

                })

</script>


@endpush