<?php

namespace App\Transformers;

use App\Entities\Testes;
use League\Fractal\TransformerAbstract;

/**
 * Class TestesTransformer.
 *
 * @package namespace App\Transformers;
 */
class TestesTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['perguntas'];

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
            'id' => (int) $model->id,

            'nome' => $model->nome,
            'data_inicio' => $model->data_inicio,
            'data_limite' => $model->data_limite,
            'valor' => $model->valor,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }

    public function includePerguntas(Testes $model) {
        return $this->collection($model->perguntas, new PerguntasTransformer());
    }
}
