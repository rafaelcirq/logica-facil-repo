<?php

namespace App\Transformers;

use App\Entities\Alternativas;
use League\Fractal\TransformerAbstract;

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
            'id' => (int) $model->id,

            'texto' => $model->texto,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }
}
