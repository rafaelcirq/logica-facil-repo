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

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
