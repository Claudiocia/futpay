<?php

namespace App\Providers;

use App\Models\Movimento;
use App\Repositories\CampeonatoRepository;
use App\Repositories\CampeonatoRepositoryEloquent;
use App\Repositories\ContaRepository;
use App\Repositories\ContaRepositoryEloquent;
use App\Repositories\DisputacampRepository;
use App\Repositories\DisputacampRepositoryEloquent;
use App\Repositories\GameRepository;
use App\Repositories\GameRepositoryEloquent;
use App\Repositories\JogoRepository;
use App\Repositories\JogoRepositoryEloquent;
use App\Repositories\MovimentoRepository;
use App\Repositories\MovimentoRepositoryEloquent;
use App\Repositories\PlataformaRepository;
use App\Repositories\PlataformaRepositoryEloquent;
use App\Repositories\RachaoRepository;
use App\Repositories\RachaoRepositoryEloquent;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryEloquent;
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
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(GameRepository::class, GameRepositoryEloquent::class);
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
