<?php

use Illuminate\Database\Seeder;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'usu_idpermissao' => 1,
            'usu_usuario' => 'admin',
            'usu_senha' => bcrypt('segredo'),
            'usu_nome' => 'Super Usuário',
            'usu_email' => 'ricardopatrickms@gmail.com',
            'usu_status' => 'ATIVO',
            'usu_data_adicionada' => date('Y-m-d H:i:s')
        ]);
    }
}
