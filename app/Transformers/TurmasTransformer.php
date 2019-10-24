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

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
