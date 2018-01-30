<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\models\Produto;

class ProdutoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $idProduto;
    protected $idLoja;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($idLoja,$idProduto)
    {
        $this->idProduto = $idProduto;
        $this->idLoja = $idLoja;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Create a client with a base URI
        $loja = \App\models\Loja::find($this->idLoja);
        
        $client  = new Client(['base_uri' => $loja->loj_urlapi]);
        $produto = Produto::find($this->idProduto);
        
        # Cadastra produto na loja
        $response = $client->request('POST', 'api/produto-store',[
            'form_params' => $produto->getAttributes()
        ]);
    }
}
