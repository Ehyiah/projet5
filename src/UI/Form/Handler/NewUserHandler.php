<?php

namespace App\UI\Form\Handler;


use App\Entity\User;
use App\Infra\Doctrine\Repository\UserRepository;
use App\UI\Form\Handler\Interfaces\NewUserHandlerInterface;
use Symfony\Component\Form\FormInterface;

class NewUserHandler implements NewUserHandlerInterface
{
    /**
     * @var UserRepository
     */
    private $user;

    /**
     * NewUserHandler constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function handle(FormInterface $form) : bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $newUser = new User($form->getData());
            $this->user->save($newUser);

            return true;
        }

        return false;
    }
}