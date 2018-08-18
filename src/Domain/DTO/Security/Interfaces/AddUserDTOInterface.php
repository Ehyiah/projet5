<?php

namespace App\Domain\DTO\Security\Interfaces;


interface AddUserDTOInterface
{
    /**
     * AddUserDTOInterface constructor.
     *
     * @param string $username
     * @param string $password
     * @param string $email
     */
    public function __construct(
        string $username,
        string $password,
        string $email
    );
}