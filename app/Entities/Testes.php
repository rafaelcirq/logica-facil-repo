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
    protected $fillable = ['turmas_id', 'nome', 'data_inicio', 'data_limite', 'valor'];

    public function perguntas()
    {
        return $this->hasMany('App\Entities\Perguntas');
    }

    public function resultados()
    {
        return $this->hasMany('App\Entities\Resultados');
    }

    public function turma()
    {
        return $this->belongsTo('App\Entities\Turmas', 'turmas_id');
    }
}
