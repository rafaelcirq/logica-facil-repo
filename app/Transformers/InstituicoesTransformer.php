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

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
