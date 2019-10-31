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

            'nome'      => $model->nome,
            'sigla'     => $model->sigla,
            'cidade'    => $model->cidade,
            'codigo'    => $model->codigo,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
