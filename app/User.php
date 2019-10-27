<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User.
 *
 * @package namespace App;
 */
class User extends Authenticatable implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'tipo'];

    public function instituicoes()
    {
        return $this->belongsToMany('App\Entities\Instituicoes', 'instituicoes_users', 'users_id', 'instituicoes_id');
    }

    public function resultados()
    {
        return $this->hasMany('App\Entities\Resultados', 'users_id');
    }

    public function turmasProfessor()
    {
        return $this->hasMany('App\Entities\Turmas', 'users_id');
    }

    public function turmasAluno()
    {
        return $this->belongsToMany('App\Entities\Turmas', 'turmas_users', 'users_id', 'turmas_id');
    }
}
