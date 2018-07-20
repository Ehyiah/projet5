<?php

namespace App\Domain\DTO\Security;


class ChangePasswordDTO
{
    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $oldPassword;


    /**
     * ChangePasswordDTO constructor.
     *
     * @param string $password
     * @param string $oldPassword
     */
    public function __construct(
        string $password,
        string $oldPassword
    ) {
        $this->password = $password;
        $this->oldPassword = $oldPassword;
    }
}