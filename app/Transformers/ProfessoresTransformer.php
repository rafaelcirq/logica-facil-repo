<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Professores;

/**
 * Class ProfessoresTransformer.
 *
 * @package namespace App\Transformers;
 */
class ProfessoresTransformer extends TransformerAbstract
{
    /**
     * Transform the Professores entity.
     *
     * @param \App\Entities\Professores $model
     *
     * @return array
     */
    public function transform(Professores $model)
    {
        return [
            'id'         => (int) $model->id,

            'nome'       => $model->nome,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeUsuario(Professores $model)
    {
        return $this->item($model->usuario, new UsuariosTransformer());
    }

    public function includeInstituicoes(Professores $model)
    {
        return $this->item($model->instituicoes, new InstituicoesTransformer());
    }
}
