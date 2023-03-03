<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\JogoRepository;
use App\Models\Jogo;
use App\Validators\JogoValidator;

/**
 * Class JogoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class JogoRepositoryEloquent extends BaseRepository implements JogoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Jogo::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
