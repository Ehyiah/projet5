<?php

namespace App\UI\Form\Handler\Security\Interfaces;


use App\Infra\Doctrine\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;
use Twig\Environment;

interface PasswordRecoverInputHandlerInterface
{
    public function __construct(
        UserRepository $userRepository,
        Environment $twig,
        \Swift_Mailer $mail
    );

    public function handle(FormInterface $form);
}