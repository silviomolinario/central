<?php

use Illuminate\Database\Seeder;
use App\models\PermissaoGrupo;

class PermissaoGrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissaoGrupo = new PermissaoGrupo();
        
        $permissaoGrupo::create([
           'gru_id' => 1, 
           'gru_nome' => 'LOGIN', 
        ]);
        
        $permissaoGrupo::create([
           'gru_id' => 2, 
           'gru_nome' => 'CONFIGURAÇÕES', 
        ]);
        
        $permissaoGrupo::create([
           'gru_id' => 3, 
           'gru_nome' => 'USUÁRIOS', 
        ]);
        
        $permissaoGrupo::create([
           'gru_id' => 4, 
           'gru_nome' => 'PRODUTOS', 
        ]);
        
        $permissaoGrupo::create([
           'gru_id' => 5, 
           'gru_nome' => 'CATEGORIA', 
        ]);
        
        $permissaoGrupo::create([
           'gru_id' => 6, 
           'gru_nome' => 'LOJA', 
        ]);
        
        $permissaoGrupo::create([
           'gru_id' => 7, 
           'gru_nome' => 'ESTOQUE', 
        ]);
        
        
        $permissaoGrupo::create([
           'gru_id' => 8, 
           'gru_nome' => 'CLIENTE', 
        ]);
        
        $permissaoGrupo::create([
           'gru_id' => 9, 
           'gru_nome' => 'CHEQUE', 
        ]);
        
        $permissaoGrupo::create([
           'gru_id' => 10, 
           'gru_nome' => 'HOME', 
        ]);
        
    }
}
