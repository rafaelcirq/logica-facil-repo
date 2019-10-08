<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TurmasRepository;
use App\Entities\Turmas;
use App\Validators\TurmasValidator;

/**
 * Class TurmasRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TurmasRepositoryEloquent extends BaseRepository implements TurmasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Turmas::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TurmasValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
