<?php

namespace App\Domain\DTO\Security;


use App\Domain\DTO\Security\Interfaces\LoginDTOInterface;

/**
 * Class LoginDTO
 */
class LoginDTO implements LoginDTOInterface
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * LoginDTO constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        string $username,
        string $password
    ) {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}