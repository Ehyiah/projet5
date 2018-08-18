<?php

namespace App\Domain\DTO\Security\Interfaces;


use Symfony\Component\Form\Extension\Core\Type\PasswordType;

interface ChangePasswordFromEmailDTOInterface
{
    /**
     * ChangePasswordFromEmailDTOInterface constructor.
     *
     * @param PasswordType|null $password
     * @param string|null $token
     */
    public function __construct(
        PasswordType $password = null,
        string $token = null
    );
}
