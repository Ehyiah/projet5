<?php

namespace App\Domain\DTO\Security\Interfaces;


interface LoginDTOInterface
{
    /**
     * LoginDTOInterface constructor.
     *
     * @param string $username
     * @param string $password
     */
    public function __construct(
        string $username,
        string $password
    );

    /**
     * @return string
     */
    public function getUsername(): string;

    /**
     * @return string
     */
    public function getPassword(): string;
}
