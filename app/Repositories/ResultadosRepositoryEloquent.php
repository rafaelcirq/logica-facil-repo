<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ResultadosRepository;
use App\Entities\Resultados;
use App\Validators\ResultadosValidator;

/**
 * Class ResultadosRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ResultadosRepositoryEloquent extends BaseRepository implements ResultadosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Resultados::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ResultadosValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
