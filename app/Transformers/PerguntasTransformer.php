<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Perguntas;

/**
 * Class PerguntasTransformer.
 *
 * @package namespace App\Transformers;
 */
class PerguntasTransformer extends TransformerAbstract
{
    /**
     * Transform the Perguntas entity.
     *
     * @param \App\Entities\Perguntas $model
     *
     * @return array
     */
    public function transform(Perguntas $model)
    {
        return [
            'id'         => (int) $model->id,

            'pontuacao'  => $model->pontuacao,
            'texto'      => $model->texto,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeAluno(Perguntas $model)
    {
        return $this->item($model->aluno, new AlunosTransformer());
    }

    public function includeTeste(Perguntas $model)
    {
        return $this->item($model->teste, new TestesTransformer());
    }

    public function includeAlternativas(Perguntas $model)
    {
        return $this->item($model->alternativas, new AlternativasTransformer());
    }
}
