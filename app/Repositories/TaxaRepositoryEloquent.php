<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TaxaRepository;
use App\Models\Taxa;
use App\Validators\TaxaValidator;

/**
 * Class TaxaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TaxaRepositoryEloquent extends BaseRepository implements TaxaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Taxa::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
