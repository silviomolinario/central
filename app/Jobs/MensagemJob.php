<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use GuzzleHttp\Client;

class MensagemJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $idLoja;
    protected $idMensagem;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($idLoja,$idMensagem)
    {
        $this->idLoja = $idLoja;
        $this->idMensagem = $idMensagem;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $loja = \App\models\Loja::find($this->idLoja);
        
        $client = new Client(['base_uri' => $loja->loj_urlapi]);
        $mensagem = \App\models\Mensagem::find($this->idMensagem);
        
        $response = $client->request('POST','api/mensagem-store',[
            'form_params' => $mensagem->getAttributes()
        ]);
    }
}
