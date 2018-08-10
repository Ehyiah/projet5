<?php

namespace App\UI\Form\Handler\Interfaces;


use App\Infra\Doctrine\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

interface LoginHandlerInterface
{
    public function __construct(
        UserRepository $userRepository,
        EncoderFactoryInterface $encoderFactory
    );

    public function handle(FormInterface $form) : bool;
}