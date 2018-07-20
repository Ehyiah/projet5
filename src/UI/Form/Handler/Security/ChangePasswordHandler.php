<?php

namespace App\UI\Form\Handler\Security;


use App\Entity\User;
use App\Infra\Doctrine\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class ChangePasswordHandler
{
    /**
     * @var TokenStorageInterface
     */
    private $security;

    /**
     * @var UserRepository
     */
    private $user;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * ChangePasswordHandler constructor.
     *
     * @param TokenStorageInterface $security
     * @param UserRepository $user
     * @param EncoderFactoryInterface $encoderFactory
     */
    public function __construct(
        TokenStorageInterface $security,
        UserRepository $user,
        EncoderFactoryInterface $encoderFactory
    ) {
        $this->security = $security;
        $this->user = $user;
        $this->encoderFactory = $encoderFactory;
    }


    public function handle(FormInterface $form)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            // recup du salt
            $encoder = $this->encoderFactory->getEncoder(User::class);

            $user = $this->security->getToken()->getUser();
            $passEncoded = $user->getPassword();

            $oldpass = $form->getData()->oldPassword;
            $newPass = $form->getData()->password;

            // renvoie true si vieux mot de passe est correct
            $checkPassword = $encoder->isPasswordValid($passEncoded, $oldpass, $encoder);

            if ($checkPassword == true) {
                // on peut changer le mot de passe
                $newPassEncoded = $encoder->encodePassword($newPass, null);
                $user->editPassword($newPassEncoded);
                dump($user);
                $this->user->edit($user);
                //die();
            }
            else {
                // on ne peut pas changer le mot de passe
            }

            return true;
        }
        return false;
    }
}