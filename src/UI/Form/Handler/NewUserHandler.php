<?php

namespace App\UI\Form\Handler;


use App\Entity\User;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\Handler\Interfaces\NewUserHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * NewUserHandler constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        UserRepositoryInterface $user,
        EncoderFactoryInterface $encoderFactory,
        ValidatorInterface $validator
    ) {
        $this->user = $user;
        $this->encoderFactory = $encoderFactory;
        $this->validator = $validator;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function handle(FormInterface $form) : bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $encoder = $this->encoderFactory->getEncoder(User::class);

            $pass0 = $encoder->encodePassword($form->getData()->password, null);
            $form->getData()->password = $pass0;

            $newUser = new User($form->getData());

            $errors = $this->validator->validate($newUser, [], ['User']);
            if (\Count($errors) > 0) {
                return false;
            }

            $this->user->save($newUser);

            return true;
        }
        return false;
    }
}
