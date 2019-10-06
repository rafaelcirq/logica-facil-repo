<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Alternativas.
 *
 * @package namespace App\Entities;
 */
class Alternativas extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['perguntas_id', 'texto', 'correta'];

    public function pergunta() {
        return $this->belongsTo(Perguntas::class, 'perguntas_id');
    }

}
