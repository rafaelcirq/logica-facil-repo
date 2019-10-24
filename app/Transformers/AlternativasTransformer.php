<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Alternativas;

/**
 * Class AlternativasTransformer.
 *
 * @package namespace App\Transformers;
 */
class AlternativasTransformer extends TransformerAbstract
{
    /**
     * Transform the Alternativas entity.
     *
     * @param \App\Entities\Alternativas $model
     *
     * @return array
     */
    public function transform(Alternativas $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
