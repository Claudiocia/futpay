<?php

namespace App\Providers;

use App\Utils\DatasExtratoValidation;
use App\Utils\ValorValidation;
use App\Utils\AutorizaAction;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);
        if($this->app->environment() !== 'production'){
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extend('cpf', '\App\Utils\CpfValidation@validate');
        \Validator::extend('idade', '\App\Utils\IdadeValidation@validate');
        \Validator::extend('valor', '\App\Utils\ValorValidation@validate');
        \Validator::extend('saldo', '\App\Utils\SaldoValidation@validate');
        \Validator::extend('ordemData', '\App\Utils\DatasExtratoValidation@ordemData');
        \Validator::extend('diferencaDias', '\App\Utils\DatasExtratoValidation@diferencaDias');
        \Validator::extend('dataFinal', '\App\Utils\DatasExtratoValidation@dataFinal');
        \Validator::extend('autor_action', '\App\Utils\AutorizaAction@autorAction');
    }
}
