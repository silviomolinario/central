<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use \App\models\Permissao;

class PermissoesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {

        $permissao = new Permissao();
        
        #Login
        $permissao->create(['perm_action' =>'LoginController@showLoginForm','perm_descricao' => 'Formulário de login','perm_idgrupo' => 1]);
        $permissao->create(['perm_action' =>'LoginController@authenticate','perm_descricao' => 'Autenticação','perm_idgrupo' => 1]);
        $permissao->create(['perm_action' =>'LoginController@logout','perm_descricao' => 'Logout','perm_idgrupo' => 1]);
        $permissao->create(['perm_action' =>'LoginController@showRegisterForm','perm_descricao' => 'Mostrar formulário de registro','perm_idgrupo' => 1]);
        $permissao->create(['perm_action' =>'LoginController@register','perm_descricao' => 'Registro','perm_idgrupo' => 1]);
        #Configuração
        $permissao->create(['perm_action' =>'ConfiguracaoController@permissao','perm_descricao' => 'Permissoes','perm_idgrupo' => 2]);
        $permissao->create(['perm_action' =>'PermissaoController@index','perm_descricao' => 'Listagem de permissões','perm_idgrupo' => 2]);
        $permissao->create(['perm_action' =>'PermissaoController@store','perm_descricao' => 'Salvar Permissões','perm_idgrupo' => 2]);
        #Usuario
        $permissao->create(['perm_action' =>'UsuarioController@index','perm_descricao' => 'Listagem de usuários','perm_idgrupo' => 3]);
        $permissao->create(['perm_action' =>'UsuarioController@create','perm_descricao' => 'Formulário criação de usuarios','perm_idgrupo' => 3]);
        $permissao->create(['perm_action' =>'UsuarioController@store','perm_descricao' => 'Criação de usuários','perm_idgrupo' => 3]);
        $permissao->create(['perm_action' =>'UsuarioController@edit','perm_descricao' => 'Formulário edição de usuários','perm_idgrupo' => 3]);
        $permissao->create(['perm_action' =>'UsuarioController@update','perm_descricao' => 'Edião de usuários','perm_idgrupo' => 3]);
        $permissao->create(['perm_action' =>'UsuarioController@block','perm_descricao' => 'Bloqueio de usuários','perm_idgrupo' => 3]);
        $permissao->create(['perm_action' =>'UsuarioController@destroy','perm_descricao' => 'Exclusão de usuários','perm_idgrupo' => 3]);
        $permissao->create(['perm_action' =>'UsuarioController@unlock','perm_descricao' => 'Desbloqueio de usuários','perm_idgrupo' => 3]);
        #Produto
        $permissao->create(['perm_action' =>'ProdutoController@index','perm_descricao' => 'Listagem de produtos','perm_idgrupo' => 4]);
        $permissao->create(['perm_action' =>'ProdutoController@create','perm_descricao' => 'Formulário cadastro de produtos','perm_idgrupo' => 4]);
        $permissao->create(['perm_action' =>'ProdutoController@store','perm_descricao' => 'Cadastro de produtos','perm_idgrupo' => 4]);
        $permissao->create(['perm_action' =>'ProdutoController@edit','perm_descricao' => 'Formulário edição de produtos','perm_idgrupo' => 4]);
        $permissao->create(['perm_action' =>'ProdutoController@update','perm_descricao' => 'Edição de produtos','perm_idgrupo' => 4]);
        $permissao->create(['perm_action' =>'ProdutoController@createDerivado','perm_descricao' => 'Formulário criação de derivados','perm_idgrupo' => 4]);
        $permissao->create(['perm_action' =>'ProdutoController@storeDerivado','perm_descricao' => 'Criação de derivados','perm_idgrupo' => 4]);
        #Categoria
        $permissao->create(['perm_action' =>'CategoriaController@index','perm_descricao' => 'Listagem de categorias','perm_idgrupo' => 5]);
        $permissao->create(['perm_action' =>'CategoriaController@create','perm_descricao' => 'Formulário criação de categorias','perm_idgrupo' => 5]);
        $permissao->create(['perm_action' =>'CategoriaController@store','perm_descricao' => 'Criação de categorias','perm_idgrupo' => 5]);
        $permissao->create(['perm_action' =>'CategoriaController@edit','perm_descricao' => 'Formulário edição de categorias','perm_idgrupo' => 5]);
        $permissao->create(['perm_action' =>'CategoriaController@update','perm_descricao' => 'Edição de categorias','perm_idgrupo' => 5]);
        $permissao->create(['perm_action' =>'CategoriaController@destroy','perm_descricao' => 'Exclusão de categorias','perm_idgrupo' => 5]);
        #Loja
        $permissao->create(['perm_action' =>'LojaController@index','perm_descricao' => 'Listagem de lojas','perm_idgrupo' => 6]);
        $permissao->create(['perm_action' =>'LojaController@create','perm_descricao' => 'Formuário criação de lojas','perm_idgrupo' => 6]);
        $permissao->create(['perm_action' =>'LojaController@store','perm_descricao' => 'Criação de lojas','perm_idgrupo' => 6]);
        $permissao->create(['perm_action' =>'LojaController@edit','perm_descricao' => 'Formulário edição de lojas','perm_idgrupo' => 6]);
        $permissao->create(['perm_action' =>'LojaController@update','perm_descricao' => 'Edição de lojas','perm_idgrupo' => 6]);
        $permissao->create(['perm_action' =>'LojaController@block','perm_descricao' => 'Bloqueio de lojas','perm_idgrupo' => 6]);
        $permissao->create(['perm_action' =>'LojaController@destroy','perm_descricao' => 'Exclusão de lojas','perm_idgrupo' => 6]);
        $permissao->create(['perm_action' =>'LojaController@unlock','perm_descricao' => 'Desbloqueio de lojas','perm_idgrupo' => 6]);
        $permissao->create(['perm_action' =>'LojaController@getAllLojas','perm_descricao' => 'Ajax - Todas as lojas','perm_idgrupo' => 6]);
        #Estoque
        $permissao->create(['perm_action' =>'EstoqueController@index','perm_descricao' => 'listagem de estoque','perm_idgrupo' => 7]);
        $permissao->create(['perm_action' =>'EstoqueController@filterProduct','perm_descricao' => 'Estoque filtro produto','perm_idgrupo' => 7]);
        $permissao->create(['perm_action' =>'EstoqueController@productStock','perm_descricao' => 'Estoque','perm_idgrupo' => 7]);
        #Cliente
        $permissao->create(['perm_action' =>'ClienteController@index','perm_descricao' => 'Listagem de clientes','perm_idgrupo' => 8]);
        $permissao->create(['perm_action' =>'ClienteController@create','perm_descricao' => 'Formulário cadastro de clientes','perm_idgrupo' => 8]);
        $permissao->create(['perm_action' =>'ClienteController@store','perm_descricao' => 'Cadastro de clientes','perm_idgrupo' => 8]);
        $permissao->create(['perm_action' =>'ClienteController@edit','perm_descricao' => 'Formulário edição de clientes','perm_idgrupo' => 8]);
        $permissao->create(['perm_action' =>'ClienteController@update','perm_descricao' => 'Edição de clientes','perm_idgrupo' => 8]);
        $permissao->create(['perm_action' =>'ClienteController@destroy','perm_descricao' => 'Exclusão de clientes','perm_idgrupo' => 8]);
        $permissao->create(['perm_action' =>'ClienteController@block','perm_descricao' => 'Bloqueio de clientes','perm_idgrupo' => 8]);
        $permissao->create(['perm_action' =>'ClienteController@unlock','perm_descricao' => 'Desloqueio de clientes','perm_idgrupo' => 8]);
        #Cheque
        $permissao->create(['perm_action' =>'ChequeController@index','perm_descricao' => 'Listagem de cheques','perm_idgrupo' => 9]);
        $permissao->create(['perm_action' =>'ChequeController@create','perm_descricao' => 'Formulário criação de cheques','perm_idgrupo' => 9]);
        $permissao->create(['perm_action' =>'ChequeController@store','perm_descricao' => 'Criação de cheques','perm_idgrupo' => 9]);
        $permissao->create(['perm_action' =>'ChequeController@show','perm_descricao' => 'Visualizar cheques','perm_idgrupo' => 9]);
        $permissao->create(['perm_action' =>'ChequeController@edit','perm_descricao' => 'Formulário edição de cheques','perm_idgrupo' => 9]);
        $permissao->create(['perm_action' =>'ChequeController@update','perm_descricao' => 'Edição de cheques','perm_idgrupo' => 9]);
        $permissao->create(['perm_action' =>'ChequeController@destroy','perm_descricao' => 'Exclusão de cheques','perm_idgrupo' => 9]);
        $permissao->create(['perm_action' =>'ChequeController@readerCreate','perm_descricao' => 'Leitura de cheques','perm_idgrupo' => 9]);
        $permissao->create(['perm_action' =>'ChequeController@readerStore','perm_descricao' => 'Leitor - Criação de cheques','perm_idgrupo' => 9]);
        $permissao->create(['perm_action' =>'ChequeController@getAllBanks','perm_descricao' => 'Ajax - Todos os bancos','perm_idgrupo' => 9]);
        #Home
        $permissao->create(['perm_action' =>'HomeController@index','perm_descricao' => 'Home','perm_idgrupo' => 10]);
        
        
        $tipos = \App\models\UsuarioTipo::all();
        $permissoes = $permissao->all();
        
        foreach ($permissoes as $p) {
            foreach ($tipos as $tipo) {
                \App\models\UsuarioTipoPermissao::create([
                    'perm_idtipo' => $tipo->tip_id,
                    'perm_idpermissao' => $p->perm_id
                ]);
            }
        }
        
        
    }

}
