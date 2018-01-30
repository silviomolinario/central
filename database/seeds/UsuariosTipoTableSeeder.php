<?php

use Illuminate\Database\Seeder;

class UsuariosTipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios_tipos')->insert([
            'tip_id'   => 1, 
            'tip_nome' => 'ADMIN',
        ]);
        
        DB::table('usuarios_tipos')->insert([
            'tip_id'   => 2,
            'tip_nome' => 'GERENTE',
        ]);
    }
}
