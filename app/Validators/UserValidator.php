<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class UserValidator.
 *
 * @package namespace App\Validators;
 */
class UserValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|max:255',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:8',
            'tipo' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required|max:255',
            'email' => 'email|required|unique:users'
        ]
    ];

    public $messages = [
        'email.unique' => 'Este email já está associado à outro usuário.'
    ];
}
