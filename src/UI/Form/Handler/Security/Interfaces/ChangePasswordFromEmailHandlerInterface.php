<?php

namespace App\UI\Form\Handler\Security\Interfaces;


use App\Infra\Doctrine\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

interface ChangePasswordFromEmailHandlerInterface
{
    public function __construct(
        UserRepository $userRepository,
        EncoderFactoryInterface $encoderFactory,
        SessionInterface $session
    );

    public function handle(FormInterface $form, Request $request);
}