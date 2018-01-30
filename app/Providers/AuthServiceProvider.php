<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        # Permossioes
        Gate::define('permissao', function ($user, $action = '') {
            
            if(!$action){
                $action = str_replace("App\Http\Controllers\\", "", Route::getCurrentRoute()->getActionName());
                $action = str_replace("Vendas\\", "", $action);
            }
            
            # Verifica se action possue restrição
            $permissao = \Illuminate\Support\Facades\DB::table('permissoes')
                    ->where('perm_action',$action)
                    ->first();
            
            if(!$permissao){
                return true;
            } 
            
            $havePermissao = \App\models\UsuarioTipoPermissao::where('perm_idtipo',$user->usu_id)
                    ->where('perm_idpermissao',$permissao->perm_id)
                    ->first();
            
            if($havePermissao){
                return true;
            }
            
            return false;
        });
    }
}
