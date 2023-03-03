<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CampeonatoRepository;
use App\Models\Campeonato;
use App\Validators\CampeonatoValidator;

/**
 * Class CampeonatoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampeonatoRepositoryEloquent extends BaseRepository implements CampeonatoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Campeonato::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
