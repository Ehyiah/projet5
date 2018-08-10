<?php

namespace App\UI\Form\Handler;


use App\Entity\User;
use App\Infra\Doctrine\Repository\UserRepository;
use App\UI\Form\Handler\Interfaces\NewUserHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class NewUserHandler implements NewUserHandlerInterface
{
    /**
     * @var UserRepository
     */
    private $user;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;



    /**
     * NewUserHandler constructor.
     *
     * @param UserRepository $user
     * @param EncoderFactoryInterface $encoderFactory
     */
    public function __construct(
        UserRepository $user,
        EncoderFactoryInterface $encoderFactory
    ) {
        $this->user = $user;
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * @param FormInterface $form
     * @return bool
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