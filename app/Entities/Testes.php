<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Testes.
 *
 * @package namespace App\Entities;
 */
class Testes extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['alunos_id', 'turmas_id', 'nota', 'valor'];

    public function aluno() {
        return $this->belongsTo(Alunos::class, 'alunos_id');
    }

    public function turma() {
        return $this->belongsTo(Turmas::class, 'turmas_id');
    }

    public function perguntas() {
        return $this->hasMany(Perguntas::class);
    }

}
