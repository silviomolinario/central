<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Permissoes
        $this->call(UsuariosTipoTableSeeder::class);
        # Usuários
        $this->call(UsuariosTableSeeder::class);
        # Bancos
        $this->call(BancoSeeder::class);
        # Grupo de permissoes
        $this->call(PermissaoGrupoSeeder::class);
        # Permissoes
        $this->call(PermissoesTableSeeder::class);
        # Usuário padrão
        $this->call(ClientePadraoSeeder::class);
        # Estados
        $this->call(StateTableSeeder::class);
    }
}
