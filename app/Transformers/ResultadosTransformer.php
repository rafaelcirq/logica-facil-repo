<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Resultados;

/**
 * Class ResultadosTransformer.
 *
 * @package namespace App\Transformers;
 */
class ResultadosTransformer extends TransformerAbstract
{
    /**
     * Transform the Resultados entity.
     *
     * @param \App\Entities\Resultados $model
     *
     * @return array
     */
    public function transform(Resultados $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
