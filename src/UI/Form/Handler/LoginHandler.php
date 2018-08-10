<?php

namespace App\UI\Form\Handler;


use App\Infra\Doctrine\Repository\UserRepository;
use App\UI\Form\Handler\Interfaces\LoginHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class LoginHandler implements LoginHandlerInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * LoginHandler constructor.
     *
     * @param UserRepository $userRepository
     * @param EncoderFactoryInterface $encoderFactory
     */
    public function __construct(
        UserRepository $userRepository,
        EncoderFactoryInterface $encoderFactory
    ) {
        $this->userRepository = $userRepository;
        $this->encoderFactory = $encoderFactory;
    }


    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form) : bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            return true;
        }

        return false;
    }
}