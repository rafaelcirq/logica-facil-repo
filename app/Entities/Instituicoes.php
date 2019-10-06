<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Instituicoes.
 *
 * @package namespace App\Entities;
 */
class Instituicoes extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome'];

    public function alunos()
    {
        return $this->hasMany(Alunos::class);
    }

    public function professores()
    {
        return $this->hasMany(Professores::class);
    }

    public function turmas()
    {
        return $this->hasMany(Turmas::class);
    }

}
