<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Testes;

/**
 * Class TestesTransformer.
 *
 * @package namespace App\Transformers;
 */
class TestesTransformer extends TransformerAbstract
{
    /**
     * Transform the Testes entity.
     *
     * @param \App\Entities\Testes $model
     *
     * @return array
     */
    public function transform(Testes $model)
    {
        return [
            'id'         => (int) $model->id,

            'valor'       => $model->valor,
            'nota'       => $model->nota,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeAluno(Testes $model)
    {
        return $this->item($model->aluno, new AlunosTransformer());
    }

    public function includeTurma(Testes $model)
    {
        return $this->item($model->turma, new TurmasTransformer());
    }

    public function includePerguntas(Testes $model)
    {
        return $this->collection($model->perguntas, new PerguntasTransformer());
    }
}
