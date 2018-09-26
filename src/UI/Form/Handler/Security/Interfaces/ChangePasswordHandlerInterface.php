<?php

namespace App\UI\Form\Handler\Security\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

interface ChangePasswordHandlerInterface
{
    /**
     * ChangePasswordHandlerInterface constructor.
     *
     * @param TokenStorageInterface $security
     * @param UserRepositoryInterface $user
     * @param EncoderFactoryInterface $encoderFactory
     */
    public function __construct(
        TokenStorageInterface $security,
        UserRepositoryInterface $user,
        EncoderFactoryInterface $encoderFactory
    );

    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handle(FormInterface $form): bool;
}
