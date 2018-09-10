<?php

namespace App\UI\Form\Handler\Security\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

interface ChangeEmailHandlerInterface
{
    /**
     * ChangeEmailHandlerInterface constructor.
     *
     * @param TokenStorageInterface $security
     * @param UserRepositoryInterface $user
     */
    public function __construct(
        TokenStorageInterface $security,
        UserRepositoryInterface $user
    );

    /**
     * @param FormInterface $form
     *
     * @return mixed
     */
    public function handle(FormInterface $form);
}
