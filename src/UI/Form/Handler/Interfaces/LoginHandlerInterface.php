<?php

namespace App\UI\Form\Handler\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

interface LoginHandlerInterface
{
    /**
     * LoginHandlerInterface constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param EncoderFactoryInterface $encoderFactory
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        EncoderFactoryInterface $encoderFactory
    );

    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handle(FormInterface $form) : bool;
}
