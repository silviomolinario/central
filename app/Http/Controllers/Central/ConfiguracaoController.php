<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use Route;
use Illuminate\Support\Facades\DB;
use \App\models\Permissao;

class ConfiguracaoController extends Controller {

    public function permissao()
    {
        $routeCollection = Route::getRoutes();

        foreach ($routeCollection as $route) {
            if ('/central' == $route->getPrefix()) {

                $action = str_replace("App\Http\Controllers\\", "", $route->getActionName());
                $action = str_replace("Central\\", "", $action);

                if ($route->uri() == 'central') {
                    continue;
                }
                
                $permissao = Permissao::where('perm_action',$action)->first();
                
                if($permissao){
                    continue;
                }
                
                echo $action .'<br>';
            }
        }
    }

}
