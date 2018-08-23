<?php

namespace App\Domain\DTO\Security;


use App\Domain\DTO\Security\Interfaces\ChangePasswordFromEmailDTOInterface;

/**
 * Class ChangePasswordFromEmailDTO
 */
class ChangePasswordFromEmailDTO implements ChangePasswordFromEmailDTOInterface
{
    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $token;

    /**
     * ChangePasswordFromEmailDTO constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        string $password = null,
        string $token = null
    ) {
        $this->password = $password;
        $this->token = $token;
    }
}
