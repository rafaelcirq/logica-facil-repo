<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

/**
 * Class UserTransformer.
 *
 * @package namespace App\Transformers;
 */
class UserTransformer extends TransformerAbstract
{
    /**
     * Transform the User entity.
     *
     * @param \App\User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id'         => (int) $model->id,

            'name'      => $model->name,
            'email'      => $model->email,
            'password'      => $model->password,
            'tipo'       => $model->tipo,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeProfessor(User $model) {
        return $this->item($model->professor, new ProfessoresTransformer());
    }

    public function includeAluno(User $model) {
        return $this->item($model->aluno, new AlunosTransformer());
    }
}
