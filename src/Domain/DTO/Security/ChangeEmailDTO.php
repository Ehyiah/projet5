<?php

namespace App\Domain\DTO\Security;


use App\Domain\DTO\Security\Interfaces\ChangeEmailDTOInterface;

/**
 * Class ChangeEmailDTO
 */
class ChangeEmailDTO implements ChangeEmailDTOInterface
{
    /**
     * @var string
     */
    public $email;

    /**
     * ChangeEmailDTO constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }
}
