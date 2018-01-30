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
        <div class="pull-left">
            <a class="btn btn-danger" href="{{url('central/pedidos/loja')}}" title="Voltar" ><i class="fa fa-arrow-left"></i>Voltar</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 portlets">
        <div class="panel">
            <div class="panel-header clearfix">
                <h3><i class="fa fa-table"></i> <strong>Vendas</strong> Lista</h3>
                <div class="control-btn">
                    <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                </div>
            </div>
            <div class="panel-content pagination2">
                <table class="table table-hover table-bordered table-dynamic">
                    <thead>
                        <tr>
                            <th>Num.</th>
                            <th>Cliente</th>
                            <th>Status</th>
                            <th>Conta</th>
                            <th>Data de vencimento</th>
                            <th>Valor</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendas AS $venda)
                        <tr>
                            <td>{{ $venda->par_id}}</td>
                            <td>{{ $venda->cli_nome}}</td>

                            <td>
                                @if($venda->par_status == 'PENDENTE')
                                <span class="badge badge-primary">EM ABERTO</span>
                                @elseif($venda->par_status == 'VENCIDA')
                                <span class="badge badge-danger">VENCIDA</span>
                                @elseif($venda->par_status == 'PAGO')
                                <span class="badge badge-success">QUITADO</span>
                                @elseif($venda->par_status == 'EXCLUIDO')
                                <span class="badge theme-color bg-purple">CANCELADO</span>
                                @endif
                            </td>
                            <td>
                                @if($venda->con_tipo_pagamento == 'LOTE')
                                <span class="badge badge-warning">LOTE</span>
                                @else
                                <span class="badge badge-primary">VENDA</span>
                                @endif
                            </td>
                            <td>{{ date('d/m/Y',strtotime($venda->par_data_vencimento))}}</td>
                            <td>{{ Reais($venda->par_valor_parcela)}}</td>
                            <td>
                                @if($venda->par_status == 'PAGO')
                                @if($cheque->venda($venda->par_id))
                                <a href="{{url('central/cheque/edit/'.$cheque->venda($venda->par_id)->relacao_idcheque)}}" class="btn btn-info btn-sm">Ver Cheque</a>
                                @else
                                <a href="#" data-venda='{{$venda->par_id}}' class="btn btn-warning btn-sm btn-vincular" title="Vincular cheque" data-toggle="modal" data-target="#modal">Vincular Cheque</a>
                                @endif
                                @endif
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
<!-- Modal -->
<div id="modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cheques</h4>
            </div>
            <div class="modal-body">
                <div v-if="erros" class="alert alert-danger">
                    @{{erros}}
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="control-label">CMC7</label>
                            <form role="form" onsubmit="return false" v-on:keyup.enter="getCheque">
                            <the-mask autocomplete="off" class="form-control" v-model="cmc7Input" id="cmc7Input" name="cmc7" :mask="['########    ##########    ############']" />
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <a v-on:click="getCheque()" style="margin-top: 25px" class="btn btn-success"><i class="fa fa-search"></i></a>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div v-if="check.che_numero_cheque">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Num.: @{{check.che_numero_cheque}}</td>
                                    <td>Banco: @{{check.banco.ban_nome}}</td>
                                </tr>
                                <tr>
                                    <td>Agencia: @{{check.che_agencia}}</td>
                                    <td>Conta: @{{check.che_conta}}</td>
                                </tr>
                                <tr>
                                    <td>Agencia: @{{check.che_id}}</td>
                                    <td>Data adicionado: @{{check.che_data_adicionado}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Valor: @{{check.che_valor}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input v-on:click="finalizar()" type="button" value="Finalizar" class="btn btn-success">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('.btn-vincular').click(function () {
        var idVenda = $(this).data('venda');
        $('#formVinculo').attr('action', base_url + '/central/pedidos/chequevinculo/' + idVenda)
    });
</script>
<script src="https://unpkg.com/vue"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.4"></script>
<script src="{{ URL::asset('js/vue-the-mask.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/v-money.js') }}" type="text/javascript"></script>

<script>

    var base_url = window.location.origin + '/';

    var venda = null;
    
    $(function () {
        $("#cmc7Input").focus();
        
        
        $('.btn-vincular').click(function(){
            venda = $(this).data('venda');
        })
    })

    new Vue({
        el: '#modal',
        data: {
            cmc7Input: null,
            check: {
                che_id: null,
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
                che_status: null,
                che_cliente_repassado: null,
                banco: {
                    ban_nome: null
                }
            },
            money: {
                decimal: ',',
                thousands: '.',
                prefix: 'R$ ',
                precision: 2,
                masked: false
            },
            erros: null,
            venda:venda
        },
        created: function () {
            this.getCheque();
        },
        methods: {
            getCheque: function () {
                var cmc7 = this.cmc7Input.replace(/[^0-9]/g, '');
                cmc7 = cmc7.substring(11, 17);

                this.$http.post(base_url + 'central/cheque/get-by-cmc7', {cmc7: cmc7}).then(function (response) {
                    
                    if(response.body.status == 'success'){
                        this.check = response.body.cheque;
                        this.erros = null;
                    } else {
                        this.erros = response.body.erros;
                        this.clear();
                    }
                    
                });
            },
            clear: function () {
                this.check.che_id = null;
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
            },
            finalizar: function(){
                
                if(!this.check.che_id){
                    return false;
                }
                
                var request = {
                    che_id: this.check.che_id
                };
                
                this.$http.post(base_url + 'central/cheque/chequevinculo/'+venda, request).then(function (response) {
                    var status = response.data.status;
                    if(status == 'success'){
                        location.reload();
                    } else {
                        notificacao(response.data.erros,'danger');
                    }
                });
            }

        }

    })

</script>
@endpush