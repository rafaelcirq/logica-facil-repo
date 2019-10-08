<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AlternativasRepository;
use App\Entities\Alternativas;
use App\Validators\AlternativasValidator;

/**
 * Class AlternativasRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AlternativasRepositoryEloquent extends BaseRepository implements AlternativasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Alternativas::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AlternativasValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
