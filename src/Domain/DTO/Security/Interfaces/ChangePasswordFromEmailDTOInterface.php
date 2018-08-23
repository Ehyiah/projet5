<?php

namespace App\Domain\DTO\Security\Interfaces;


interface ChangePasswordFromEmailDTOInterface
{
    /**
     * ChangePasswordFromEmailDTOInterface constructor.
     *
     * @param string|null $password
     * @param string|null $token
     */
    public function __construct(
        string $password = null,
        string $token = null
    );
}
