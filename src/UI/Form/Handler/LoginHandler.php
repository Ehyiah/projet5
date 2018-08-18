<?php

namespace App\UI\Form\Handler;


use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\Handler\Interfaces\LoginHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class LoginHandler
 */
final class LoginHandler implements LoginHandlerInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * LoginHandler constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        EncoderFactoryInterface $encoderFactory
    ) {
        $this->userRepository = $userRepository;
        $this->encoderFactory = $encoderFactory;
    }


    /**
     * {@inheritdoc}
     */
    public function handle(FormInterface $form) : bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            return true;
        }

        return false;
    }
}
