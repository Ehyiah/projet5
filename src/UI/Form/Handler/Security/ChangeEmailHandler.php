<?php

namespace App\UI\Form\Handler\Security;


use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\Handler\Security\Interfaces\ChangeEmailHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class ChangeEmailHandler
 */
class ChangeEmailHandler implements ChangeEmailHandlerInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $security;

    /**
     * @var UserRepositoryInterface
     */
    private $user;

    /**
     * ChangeEmailHandler constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        TokenStorageInterface $security,
        UserRepositoryInterface $user
    ) {
        $this->security = $security;
        $this->user = $user;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(FormInterface $form)
    {
        if ($form->isSubmitted() && ($form->isValid())) {

            $user = $this->security->getToken()->getUser();

            $user->editEmail($form->getData()->email);
            $this->user->edit($user);

            return true;
        }

        return false;
    }
}
