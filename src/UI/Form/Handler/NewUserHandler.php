<?php

namespace App\UI\Form\Handler;


use App\Entity\User;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\Handler\Interfaces\NewUserHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class NewUserHandler
 */
final class NewUserHandler implements NewUserHandlerInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $user;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * NewUserHandler constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        UserRepositoryInterface $user,
        EncoderFactoryInterface $encoderFactory
    ) {
        $this->user = $user;
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(FormInterface $form) : bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $encoder = $this->encoderFactory->getEncoder(User::class);

            $pass0 = $encoder->encodePassword($form->getData()->password, null);
            $form->getData()->password = $pass0;

            $newUser = new User($form->getData());
            $this->user->save($newUser);

            return true;
        }
        return false;
    }
}
