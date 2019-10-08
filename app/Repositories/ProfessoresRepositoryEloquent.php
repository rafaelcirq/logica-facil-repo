<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProfessoresRepository;
use App\Entities\Professores;
use App\Validators\ProfessoresValidator;

/**
 * Class ProfessoresRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProfessoresRepositoryEloquent extends BaseRepository implements ProfessoresRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Professores::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ProfessoresValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
