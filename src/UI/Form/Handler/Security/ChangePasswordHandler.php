<?php

namespace App\UI\Form\Handler\Security;


use App\Entity\User;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\Handler\Security\Interfaces\ChangePasswordHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class ChangePasswordHandler
 */
final class ChangePasswordHandler implements ChangePasswordHandlerInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $security;

    /**
     * @var UserRepositoryInterface
     */
    private $user;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * ChangePasswordHandler constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        TokenStorageInterface $security,
        UserRepositoryInterface $user,
        EncoderFactoryInterface $encoderFactory
    ) {
        $this->security = $security;
        $this->user = $user;
        $this->encoderFactory = $encoderFactory;
    }


    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $encoder = $this->encoderFactory->getEncoder(User::class);

            $user = $this->security->getToken()->getUser();
            $passEncoded = $user->getPassword();

            $oldPass = $form->getData()->oldPassword;
            $newPass = $form->getData()->password;

            if ($encoder->isPasswordValid($passEncoded, $oldPass, null)) {
                $user->editPassword($encoder->encodePassword($newPass, null));
                $this->user->edit($user);

                return true;
            }
        }

        return false;
    }
}
