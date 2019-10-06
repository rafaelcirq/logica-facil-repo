<?php

namespace App\Entities;

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
    protected $fillable = ['user_id'];

    public function instituicoes() {
        return $this->belongsToMany(Instituicoes::class, 'alunos_has_instituicoes', 'alunos_id', 'instituicoes_id');
    }

    public function turmas() {
        return $this->belongsToMany(Turmas::class, 'turmas_has_alunos', 'turmas_id', 'professores_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function testes() {
        return $this->hasMany(Testes::class);
    }

    public function sessoes() {
        return $this->hasMany(Sessoes::class);
    }

}
