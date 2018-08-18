<?php

namespace App\Domain\DTO\Security;


use App\Domain\DTO\Security\Interfaces\AddUserDTOInterface;

/**
 * Class AddUserDTO
 */
class AddUserDTO implements AddUserDTOInterface
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
     * @var string
     */
    public $email;


    /**
     * AddUserDTO constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        string $username,
        string $password,
        string $email
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }
}