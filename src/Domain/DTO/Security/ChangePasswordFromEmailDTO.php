<?php

namespace App\Domain\DTO\Security;


use App\Domain\DTO\Security\Interfaces\ChangePasswordFromEmailDTOInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

/**
 * Class ChangePasswordFromEmailDTO
 */
class ChangePasswordFromEmailDTO implements ChangePasswordFromEmailDTOInterface
{
    /**
     * @var PasswordType
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
        PasswordType $password = null,
        string $token = null
    ) {
        $this->password = $password;
        $this->token = $token;
    }
}
