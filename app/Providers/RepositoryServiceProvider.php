<?php

namespace App\Providers;

use App\Models\Movimento;
use App\Repositories\CampeonatoRepository;
use App\Repositories\CampeonatoRepositoryEloquent;
use App\Repositories\ContaRepository;
use App\Repositories\ContaRepositoryEloquent;
use App\Repositories\DisputacampRepository;
use App\Repositories\DisputacampRepositoryEloquent;
use App\Repositories\JogoRepository;
use App\Repositories\JogoRepositoryEloquent;
use App\Repositories\MovimentoRepository;
use App\Repositories\MovimentoRepositoryEloquent;
use App\Repositories\PlataformaRepository;
use App\Repositories\PlataformaRepositoryEloquent;
use App\Repositories\RachaoRepository;
use App\Repositories\RachaoRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PlataformaRepository::class, PlataformaRepositoryEloquent::class);
        $this->app->bind(ContaRepository::class, ContaRepositoryEloquent::class);
        $this->app->bind(CampeonatoRepository::class, CampeonatoRepositoryEloquent::class);
        $this->app->bind(DisputacampRepository::class, DisputacampRepositoryEloquent::class);
        $this->app->bind(JogoRepository::class, JogoRepositoryEloquent::class);
        $this->app->bind(MovimentoRepository::class, MovimentoRepositoryEloquent::class);
        $this->app->bind(RachaoRepository::class, RachaoRepositoryEloquent::class);
        //:end-bindings:
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
