<?php

namespace App\Domain\DTO\Security;


use App\Domain\DTO\Security\Interfaces\PasswordRecoverInputDTOInterface;

class PasswordRecoverInputDTO implements PasswordRecoverInputDTOInterface
{
    /**
     * @var string
     */
    public $name;

    /**
     * PasswordRecoverInputDTO constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
