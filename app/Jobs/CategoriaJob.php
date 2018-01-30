<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\models\Categoria;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class CategoriaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $idCategoria;
    protected $idLoja;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($idLoja,$idCategoria)
    {
        $this->idCategoria = $idCategoria;
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
        
        $client    = new Client(['base_uri' => $loja->loj_urlapi]);
        $categoria = Categoria::find($this->idCategoria);
        
        # Cadastra produto na loja
        $response = $client->request('POST', 'api/categoria-store',[
            'form_params' => $categoria->getAttributes()
        ]);
    }
}
