<?php

namespace App\Domain\DTO\Security\Interfaces;


interface ChangePasswordDTOInterface
{
    /**
     * ChangePasswordDTOInterface constructor.
     *
     * @param string $password
     * @param string $oldPassword
     */
    public function __construct(
        string $password,
        string $oldPassword
    );
}
