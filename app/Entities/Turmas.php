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
    protected $fillable = ['instituicoes_id', 'professores_id', 'nome'];

    public function alunos() {
        return $this->hasMany(Alunos::class, 'turmas_has_alunos', 'turmas_id', 'alunos_id');
    }

    public function instituicao() {
        return $this->belongsTo(Instituicoes::class, 'instituicoes_id');
    }

    public function professor() {
        return $this->belongsTo(Professores::class, 'professores_id');
    }

    public function testes() {
        return $this->hasMany(Testes::class);
    }

}
