<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RachaoRepository;
use App\Models\Rachao;
use App\Validators\RachaoValidator;

/**
 * Class RachaoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RachaoRepositoryEloquent extends BaseRepository implements RachaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Rachao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
