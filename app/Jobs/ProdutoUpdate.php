<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProdutoUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $idLoja; 
    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($idLoja,$data)
    {
        $this->idLoja = $idLoja;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $loja = \App\models\Loja::find($this->idLoja);
        
        $client = new \GuzzleHttp\Client(['base_uri' => $loja->loj_urlapi]);
        
        $response = $client->request('POST','api/produto-update',[
            'form_params' => $this->data
        ]);
    }
}
