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
    protected $defaultIncludes = ['alternativas'];

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

            'texto' => $model->texto,
            'valor' => $model->valor,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeAlternativas(Perguntas $model) {
        return $this->collection($model->alternativas, new AlternativasTransformer());
    }
}
