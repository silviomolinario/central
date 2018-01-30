<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ClienteBlockJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $idLoja; 
    protected $codigoCentral;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($idLoja,$codigoCentral)
    {
        $this->idLoja = $idLoja;
        $this->codigoCentral = $codigoCentral;
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
        
        #bloqueio de cliente na loja
        $response = $client->request('GET','/api/cliente-block/'.$this->codigoCentral);
    }
}
