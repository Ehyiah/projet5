<?php

namespace App\Controller\Security\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\Handler\Security\Interfaces\ChangePasswordFromEmailHandlerInterface;
use App\UI\Responder\Security\Interfaces\ChangePasswordFromEmailResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

interface ChangePasswordFromEmailActionInterface
{
    /**
     * ChangePasswordFromEmailActionInterface constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param TokenStorageInterface $security
     * @param FormFactoryInterface $formFactory
     * @param ChangePasswordFromEmailHandlerInterface $handler
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        TokenStorageInterface $security,
        FormFactoryInterface $formFactory,
        ChangePasswordFromEmailHandlerInterface $handler
    ) ;

    /**
     * @param Request $request
     * @param ChangePasswordFromEmailResponderInterface $responder
     * @param $token
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        ChangePasswordFromEmailResponderInterface $responder,
        $token
    );
}
