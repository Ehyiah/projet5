<?php

namespace App\Domain\DTO\Security;


use App\Domain\DTO\Security\Interfaces\ChangePasswordDTOInterface;

/**
 * Class ChangePasswordDTO
 */
class ChangePasswordDTO implements ChangePasswordDTOInterface
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
     * {@inheritdoc}
     */
    public function __construct(
        string $password,
        string $oldPassword
    ) {
        $this->password = $password;
        $this->oldPassword = $oldPassword;
    }
}