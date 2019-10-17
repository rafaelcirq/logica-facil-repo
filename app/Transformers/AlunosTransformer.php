<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Alunos;

/**
 * Class AlunosTransformer.
 *
 * @package namespace App\Transformers;
 */
class AlunosTransformer extends TransformerAbstract
{
    // protected $defaultIncludes = ['turmas'];

    /**
     * Transform the Alunos entity.
     *
     * @param \App\Entities\Alunos $model
     *
     * @return array
     */
    public function transform(Alunos $model)
    {
        return [
            'id'         => (int) $model->id,

            'nome'       => $model->nome,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeUsuario(Alunos $model)
    {
        return $this->item($model->usuario, new UsuariosTransformer());
    }

    public function includeInstituicoes(Alunos $model)
    {
        return $this->item($model->instituicoes, new InstituicoesTransformer());
    }

    public function includeTestes(Alunos $model)
    {
        return $this->collection($model->testes, new TestesTransformer());
    }

    public function includeTurmas(Alunos $model)
    {
        return $this->collection($model->turmas, new TurmasTransformer());
    }
}
