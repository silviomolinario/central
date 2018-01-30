<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * API
 */
Route::post('/api/cliente-store', 'ApiClienteController@store');

Route::get('/teste', 'TesteController@index');
Route::get('/teste/cliente', 'TesteController@cliente');

/**
 * Rota Padrão
 */
Route::get('/', function() {
    return redirect('central/home');
});

/**
 * Area Vendas
 */
Route::group(['prefix' => 'central'], function () {
    
        // Configurações
        Route::get('/configuracao/pendente','Central\ConfiguracaoController@permissao');
        Route::get('/configuracao/permissoes','Central\PermissaoController@index');
        Route::post('/configuracao/permissoes','Central\PermissaoController@store');
        // Login e registro
        Route::get('/login', 'LoginController@showLoginForm');
        Route::post('/login/authenticate', 'LoginController@authenticate');
        Route::get('/login/logout', 'LoginController@logout');
        Route::get('/register', 'LoginController@showRegisterForm');
        Route::post('/register', 'LoginController@register');

        //Route::get('teste', 'TesteController@index');

        // ROTAS COM AUTENTICAÇÃO
        Route::group(['middleware' => ['auth:web']], function() {

        //usuarios
        Route::get('usuario', 'UsuarioController@index');
        Route::get('usuario/create', 'UsuarioController@create');
        Route::post('usuario/store', 'UsuarioController@store');
        Route::get('usuario/edit/{id}', 'UsuarioController@edit');
        Route::post('usuario/update', 'UsuarioController@update');
        Route::get('usuario/block/{id}', 'UsuarioController@block');
        Route::get('usuario/destroy/{id}', 'UsuarioController@destroy');
        Route::get('usuario/unlock/{id}', 'UsuarioController@unlock');

        //produtos
        Route::get('produto', 'ProdutoController@index');
        Route::get('produto/create', 'ProdutoController@create');
        Route::post('produto/store', 'ProdutoController@store');
        Route::get('produto/edit/{id}', 'ProdutoController@edit');
        Route::post('produto/update', 'ProdutoController@update');
        Route::get('produto/destroy/{idProduto}', 'ProdutoController@destroy');
        Route::get('produto/createderivado/{idProduto}', 'ProdutoController@createDerivado');
        Route::post('produto/storederivado/{idProduto}', 'ProdutoController@storeDerivado');

        //categorias
        Route::get('categoria','CategoriaController@index');
        Route::get('categoria/create','CategoriaController@create');
        Route::post('categoria/store','CategoriaController@store');
        Route::get('categoria/edit/{id}','CategoriaController@edit');
        Route::post('categoria/update','CategoriaController@update');
        Route::get('categoria/destroy/{id}', 'CategoriaController@destroy');
        //loja
        Route::get('loja', 'LojaController@index');
        Route::get('loja/create', 'LojaController@create');
        Route::post('loja/store', 'LojaController@store');
        Route::get('loja/edit/{id}', 'LojaController@edit');
        Route::post('loja/update', 'LojaController@update');
        Route::get('loja/block/{id}', 'LojaController@block');
        Route::get('loja/destroy/{id}', 'LojaController@destroy');
        Route::get('loja/unlock/{id}', 'LojaController@unlock');
        Route::get('loja/getAllLojas', 'LojaController@getAllLojas');
        //estoque
        Route::get('estoque','EstoqueController@index');
        Route::get('estoque/filterproduct', 'EstoqueController@filterProduct');
        Route::get('estoque/stock', 'EstoqueController@productStock');

        //cliente
        Route::get('cliente','ClienteController@index');
        Route::get('cliente/create','ClienteController@create');
        Route::post('cliente/store','ClienteController@store');
        Route::get('cliente/edit/{id}','ClienteController@edit');
        Route::post('cliente/update','ClienteController@update');
        Route::get('cliente/destroy/{id}', 'ClienteController@destroy');
        Route::get('cliente/block/{id}', 'ClienteController@block');
        Route::get('cliente/unlock/{id}', 'ClienteController@unlock');
        
        # AJAX
        Route::get('cliente/getall', 'ClienteController@getAll');
        
        
        //cheque
        Route::any('cheque','ChequeController@index');
        Route::get('cheque/create','ChequeController@create');
        Route::post('cheque/store','ChequeController@store');
        Route::get('cheque/show/{id}','ChequeController@show');
        Route::get('cheque/edit/{id}','ChequeController@edit');
        Route::post('cheque/update','ChequeController@update');
        Route::get('cheque/destroy/{id}', 'ChequeController@destroy');
        Route::get('cheque/readercreate', 'ChequeController@readerCreate');
        Route::post('cheque/readerstore', 'ChequeController@readerStore');
        Route::get('cheque/getAllBanks', 'ChequeController@getAllBanks');
        
        Route::get('cheque/getStoreClientes/{idLoja}', 'ChequeController@getStoreClientes');
        Route::get('cheque/getClienteSeller/{idLoja}/{idCliente}', 'ChequeController@getClienteVendasCheck');
        
        Route::post('cheque/get-by-cmc7', 'ChequeController@getByCmc7');
    
        // Pedidos
        Route::get('pedidos', 'Central\PedidoController@pedidos');
        Route::get('pedidos/loja', 'Central\PedidoController@lojas');
        Route::post('cheque/chequevinculo/{idVenda}', 'Central\PedidoController@chequeVinculo');
        
        Route::get('caixa-mensagem/create','MensagemController@create');
        Route::post('caixa-mensagem/store','MensagemController@store');
        
        // Home
        Route::get('/', function() {
            return redirect('central/home');
        });

        Route::get('/home', 'HomeController@index');
        
    }); // FIM ROTAS AUTENTICAÇÃO
});
  