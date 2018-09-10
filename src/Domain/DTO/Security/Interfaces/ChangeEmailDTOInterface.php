<?php

namespace App\Domain\DTO\Security\Interfaces;


interface ChangeEmailDTOInterface
{
    /**
     * ChangeEmailDTOInterface constructor.
     *
     * @param string $email
     */
    public function __construct(string $email);
}
