<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ClienteCodigoCentralUpdateJob implements ShouldQueue
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
        #create a client with a base URI
        $loja = \App\models\Loja::find($this->idLoja);
        
        $client = new \GuzzleHttp\Client(['base_uri' => $loja->loj_urlapi]);
        
        #edicão de cliente na loja
        $response = $client->request('POST','api/cliente-update',[
            'form_params' => $this->data
        ]);
    }
}
