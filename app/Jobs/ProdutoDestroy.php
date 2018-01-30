<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProdutoDestroy implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $idLoja;
    protected $idProduto;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($idLoja,$idProduto)
    {
        $this->idLoja = $idLoja;
        $this->idProduto = $idProduto;
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
        
        $client = new \GuzzleHttp\Client(['base_uri' => $loja->loj_urlapi]);
        
        #exclusao de produto nas lojas
        $response = $client->request('GET','api/produto-destroy/'.$this->idProduto);
    }
}
