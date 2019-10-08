<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PerguntasRepository;
use App\Entities\Perguntas;
use App\Validators\PerguntasValidator;

/**
 * Class PerguntasRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PerguntasRepositoryEloquent extends BaseRepository implements PerguntasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Perguntas::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PerguntasValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
