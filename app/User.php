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

    public function professor()
    {
        return $this->hasOne(Professores::class, 'professores_id');
    }

    public function aluno()
    {
        return $this->hasOne(Alunos::class, 'alunos_id');
    }

}
