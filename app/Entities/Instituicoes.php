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
    protected $fillable = ['nome', 'sigla', 'cidade'];

    public function turmas()
    {
        return $this->hasMany('App\Entities\Turmas');
    }

    public function usuarios()
    {
        return $this->belongsToMany('App\User', 'instituicoes_users', 'instituicoes_id', 'users_id');
    }
}
