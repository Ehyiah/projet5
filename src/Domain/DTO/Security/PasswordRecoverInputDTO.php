<?php

namespace App\Domain\DTO\Security;


class PasswordRecoverInputDTO
{
    /**
     * @var string
     */
    public $name;

    /**
     * PasswordRecoverInputDTO constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }


}