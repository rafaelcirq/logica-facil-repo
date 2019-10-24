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

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
