<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class TurmasValidator.
 *
 * @package namespace App\Validators;
 */
class TurmasValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|max:255',
            'users_id' => 'required',
            'instituicoes_id' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|max:255',
            'users_id' => 'required',
            'instituicoes_id' => 'required',
        ],
    ];
}
