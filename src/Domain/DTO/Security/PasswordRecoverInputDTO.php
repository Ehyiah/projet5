<?php

namespace App\Domain\DTO\Security;


use App\Domain\DTO\Security\Interfaces\PasswordRecoverInputDTOInterface;

/**
 * Class PasswordRecoverInputDTO
 */
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
