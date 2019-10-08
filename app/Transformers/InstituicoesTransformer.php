<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Instituicoes;

/**
 * Class InstituicoesTransformer.
 *
 * @package namespace App\Transformers;
 */
class InstituicoesTransformer extends TransformerAbstract
{
    /**
     * Transform the Instituicoes entity.
     *
     * @param \App\Entities\Instituicoes $model
     *
     * @return array
     */
    public function transform(Instituicoes $model)
    {
        return [
            'id'         => (int) $model->id,

            'nome'       => $model->nome,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeAlunos(Instituicoes $model)
    {
        return $this->collection($model->alunos, new AlunosTransformer());
    }

    public function includeProfessores(Instituicoes $model)
    {
        return $this->collection($model->professores, new ProfessoresTransformer());
    }
}
