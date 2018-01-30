<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\models\Cliente;
use App\models\Loja;

class ClienteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $idCliente;
    protected $idLoja;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($idLoja,$idCliente)
    {
        $this->idLoja    = $idLoja;
        $this->idCliente = $idCliente;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Create a client with a base URI
        $loja = Loja::find($this->idLoja);
        $client = new Client(['base_uri' => $loja->loj_urlapi]);
        
        $cliente  = Cliente::find($this->idCliente);
        
        $dataCliente  = $cliente->getAttributes();
        $dataEndereco = $cliente->endereco->getAttributes();
        
        $movel = $cliente->contatos()->where('contato_tipo','MOVEL')->first();
        $fixo  = $cliente->contatos()->where('contato_tipo','FIXO')->first();
        $fax   = $cliente->contatos()->where('contato_tipo','FAX')->first();
        
        $contatos['contato'] = [];
        # Código da loja da loja cadastradora
        $dataCliente['cli_codigo_central']  = $cliente->cli_codigo_central;
        
        if($movel){
            $contatos['contato']['MOVEL'] = $movel->contato_numero;
            $contatos['contato_idoperadora'] = $movel->contato_idoperadora;
        }
        
        if($fixo){
            $contatos['contato']['FIXO']  = $fixo->contato_numero;
        }
        
        if($fax){
            $contatos['contato']['FAX']   = $fax->contato_numero;
        }
        
        $dataPost = array_merge($contatos,$dataCliente,$dataEndereco);
        
        # Cadastra produto na loja
        $response = $client->request('POST', 'api/cliente-store',[
            'form_params' => $dataPost
        ]);
        
    }
}
