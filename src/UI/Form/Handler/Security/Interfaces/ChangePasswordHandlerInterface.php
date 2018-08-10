<?php

namespace App\UI\Form\Handler\Security\Interfaces;


use App\Infra\Doctrine\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

interface ChangePasswordHandlerInterface
{
    public function __construct(
        TokenStorageInterface $security,
        UserRepository $user,
        EncoderFactoryInterface $encoderFactory
    );

    public function handle(FormInterface $form);
}