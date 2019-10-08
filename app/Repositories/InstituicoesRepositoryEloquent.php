<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InstituicoesRepository;
use App\Entities\Instituicoes;
use App\Validators\InstituicoesValidator;

/**
 * Class InstituicoesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InstituicoesRepositoryEloquent extends BaseRepository implements InstituicoesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Instituicoes::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return InstituicoesValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
