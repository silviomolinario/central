<?php

namespace App\Http\Controllers\Central;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Loja;
use Illuminate\Support\Facades\DB;
use Validator;

class PedidoController extends Controller {

    public function lojas() {
        $lojas = Loja::all();

        $data['lojas'] = converteArray($lojas, 'loj_id', 'loj_nome');
        return View('central/pedido/lojas', $data);
    }

    public function pedidos(Request $request) {
        $this->validate($request, ['loja' => 'required']);

        $loja = Loja::find($request->loja);

        if ($loja) {

            if (!$loja->loj_slave_ativo) {
                return redirect('central/pedidos/loja')->with('alert-danger', 'Replica não configurada');
            }

            $data['cheques'] = [null => 'Selecione o cheque'] + $this->formtCheque($loja->chequesAguardo());
            $data['vendas'] = $loja->getVendasCheck();
            $data['cheque'] = new \App\models\Cheque();

            return View('central/pedido/index', $data);
        } else {
            return redirect('central/pedidos/loja');
        }
    }

    public function formtCheque($cheques) {
        $array = [];

        if (count($cheques)) {
            foreach ($cheques AS $cheque) {

                if (!$cheque->hasParcela) {
                    $array[$cheque->che_id] = "ID: "
                            . $cheque->che_id . ", "
                            . "NUM: " . $cheque->che_numero_cheque . ", "
                            . "VALOR: " . reais($cheque->che_valor);
                }
            }
        }

        return $array;
    }

    public function chequeVinculo(Request $request, $idVenda) 
    {
        $messages = [
            'che_id.required' => 'Cheque não encontrado',
        ];

        $validation = Validator::make($request->all(), [
                    'che_id' => 'required',
                        ], $messages);

        $response = [];
        $errosMessage = '';

        if ($validation->fails()) {

            foreach ($validation->errors()->messages() as $error) {
                foreach ($error as $value) {
                    $errosMessage .= $value;
                }
            }

            $response['erros'] = $errosMessage;
            $response['status'] = 'failed';

            return $response;
        } else {

            $cheque = \App\models\Cheque::where('che_id', $request->che_id)->first();
            $loja = Loja::find($cheque->che_loja);

            if (!$cheque) {
                $response['erros'] = "Cheque não encontrado";
                $response['status'] = 'failed';
                return $response;
            }
            
            if(\App\models\ContaParcelaReceberCheque::where('relacao_idcheque',$cheque->che_id)->first()){
                $response['erros'] = "Cheque já vinculado";
                $response['status'] = 'failed';
                return $response;
            }

            $venda = $loja->getSlaveVenda($idVenda);

            if ($venda->par_valor_parcela != $cheque->che_valor) {
                $response['erros'] = "Cheque não corresponde ao valor da venda!";
                $response['status'] = 'failed';
                return $response;
            }


            try {

                DB::beginTransaction();

                \App\models\ContaParcelaReceberCheque::create([
                    'relacao_idcheque' => $request->che_id,
                    'relacao_idparcela' => $idVenda,
                ]);

                DB::commit();

                $response['erros'] = '';
                $response['status'] = 'success';
                return $response;
            } catch (Exception $exc) {

                DB::rollBack();

                $response['erros'] = '';
                $response['status'] = 'failed';
                return $response;
            }
        }
    }

}
