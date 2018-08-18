<?php

namespace App\UI\Form\Handler\Security\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Twig\Environment;

interface PasswordRecoverInputHandlerInterface
{
    /**
     * PasswordRecoverInputHandlerInterface constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param Environment $twig
     * @param \Swift_Mailer $mail
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        Environment $twig,
        \Swift_Mailer $mail
    );

    /**
     * @param FormInterface $form
     *
     * @return mixed
     */
    public function handle(FormInterface $form);
}
