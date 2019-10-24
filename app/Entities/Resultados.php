<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Resultados.
 *
 * @package namespace App\Entities;
 */
class Resultados extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function teste()
    {
        return $this->belongsTo('App\Entities\Testes', 'testes_id');
    }

    public function usuario()
    {
        return $this->belongsTo('App\User', 'users_id');
    }

}
