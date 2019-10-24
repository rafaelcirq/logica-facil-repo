<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Turmas.
 *
 * @package namespace App\Entities;
 */
class Turmas extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function testes()
    {
        return $this->hasMany('App\Entities\Testes');
    }

    public function professor()
    {
        return $this->belongsTo('App\User', 'users_id');
    }

    public function alunos()
    {
        return $this->belongsToMany('App\User', 'turmas_users', 'turmas_id', 'users_id');
    }
}
