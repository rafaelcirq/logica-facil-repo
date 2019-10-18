<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Professores.
 *
 * @package namespace App\Entities;
 */
class Professores extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['users_id'];

    public function user() {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function instituicoes() {
        return $this->belongsToMany(Instituicoes::class);
    }

    public function turmas() {
        return $this->hasMany(Turmas::class);
    }

}
