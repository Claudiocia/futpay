<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MovimentoRepository;
use App\Models\Movimento;
use App\Validators\MovimentoValidator;

/**
 * Class MovimentoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MovimentoRepositoryEloquent extends BaseRepository implements MovimentoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Movimento::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
