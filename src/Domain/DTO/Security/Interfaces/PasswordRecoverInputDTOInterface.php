<?php

namespace App\Domain\DTO\Security\Interfaces;


interface PasswordRecoverInputDTOInterface
{
    /**
     * PasswordRecoverInputDTOInterface constructor.
     *
     * @param string $name
     */
    public function __construct(string $name);
}