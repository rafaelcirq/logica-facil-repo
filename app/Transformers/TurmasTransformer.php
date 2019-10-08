<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Turmas;

/**
 * Class TurmasTransformer.
 *
 * @package namespace App\Transformers;
 */
class TurmasTransformer extends TransformerAbstract
{
    /**
     * Transform the Turmas entity.
     *
     * @param \App\Entities\Turmas $model
     *
     * @return array
     */
    public function transform(Turmas $model)
    {
        return [
            'id'         => (int) $model->id,

            'nome'       => $model->nome,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeInstituicao(Turmas $model)
    {
        return $this->item($model->instituicao, new InstituicoesTransformer());
    }

    public function includeProfessor(Turmas $model)
    {
        return $this->item($model->professor, new ProfessoresTransformer());
    }

    public function includeTestes(Turmas $model)
    {
        return $this->collection($model->testes, new TestesTransformer());
    }
}
