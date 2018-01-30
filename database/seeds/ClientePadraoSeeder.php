<?php

use Illuminate\Database\Seeder;

class ClientePadraoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $cliente = \App\models\Cliente::create([
            'cli_id'      => 1,
            'cli_codigo_central'      => 1,
            'cli_nome'                => 'CLIENTE CONSUMIDOR',
            'cli_apelido'             => 'N\A',
            'cli_identificacao'       => 'N\A',
            'cli_tipo_identificacao'  => 'FISICA',
            'cli_inscricao_estadual'  => 'N\A',
            'cli_inscricao_municipal' => 'N\A',
            'cli_nome_contato'        => 'N\A',
            'cli_endereco_site'       => 'N\A',
            'cli_observacoes'         => 'N\A',
            'cli_status'              => 'ATIVO',
            'cli_data_adicionado'     => date('Y-m-d H:i:s'),
        ]); 
       
        $cliente->endereco()->create([
            'end_iduf'        => 1,
            'end_idcliente'   => 'N\A',
            'end_numero'      => 'N\A',
            'end_endereco'    => 'N\A',
            'end_complemento' => 'N\A',
            'end_bairro'      => 'N\A',
            'end_cidade'      => 'N\A',
            'end_cep'         => 'N\A',
        ]);
    }
}
