<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Perguntas.
 *
 * @package namespace App\Entities;
 */
class Perguntas extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['pontuacao', 'texto'];

    public function teste() {
        return $this->belongsTo(Testes::class, 'testes_id');
    }

    public function alternativas() {
        return $this->hasMany(Alternativas::class);
    }

}
