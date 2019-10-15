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
            'email' => 'required|unique:users',
            'password' => 'required',
            'tipo' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'tipo' => 'required',
        ],
    ];

    public $messages = [
        'email.unique' => 'Este email já está cadastrado em nosso sistema.'
    ];
}
