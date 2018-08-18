<?php

namespace App\UI\Form\Handler\Security\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

interface ChangePasswordFromEmailHandlerInterface
{
    /**
     * ChangePasswordFromEmailHandlerInterface constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param EncoderFactoryInterface $encoderFactory
     * @param SessionInterface $session
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        EncoderFactoryInterface $encoderFactory,
        SessionInterface $session
    );

    /**
     * @param FormInterface $form
     * @param Request $request
     *
     * @return mixed
     */
    public function handle(FormInterface $form, Request $request);
}
