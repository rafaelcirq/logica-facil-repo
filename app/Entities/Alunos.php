<?php

namespace App\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Alunos.
 *
 * @package namespace App\Entities;
 */
class Alunos extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['users_id'];

    protected $with = array('user');

    public function instituicoes() {
        return $this->belongsToMany(Instituicoes::class, 'alunos_has_instituicoes', 'alunos_id', 'instituicoes_id');
    }

    public function turmas() {
        return $this->belongsToMany(Turmas::class, 'turmas_has_alunos');
    }

    public function user() {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function testes() {
        return $this->belongsToMany(Testes::class, 'alunos_has_testes');
    }

    public function sessoes() {
        return $this->hasMany(Sessoes::class);
    }

}
