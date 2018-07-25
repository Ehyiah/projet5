<?php

namespace App\Domain\DTO\Security;


use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ChangePasswordFromEmailDTO
{
    /**
     * @var PasswordType
     */
    public $password;

    /**
     * @var string
     */
    public $token;

    /**
     * ChangePasswordFromEmailDTO constructor.
     *
     * @param PasswordType|null $password
     * @param string|null $token
     */
    public function __construct(
        PasswordType $password = null,
        string $token = null
    ) {
        $this->password = $password;
        $this->token = $token;
    }
}