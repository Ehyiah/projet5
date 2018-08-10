<?php

namespace App\Controller\Security\Interfaces;


use App\Infra\Doctrine\Repository\UserRepository;
use App\UI\Form\Handler\Security\ChangePasswordFromEmailHandler;
use App\UI\Responder\Security\ChangePasswordFromEmailResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

interface ChangePasswordFromEmailActionInterface
{
    public function __construct(
        UserRepository $userRepository,
        TokenStorageInterface $security,
        FormFactoryInterface $formFactory
    );

    public function __invoke(
        Request $request,
        ChangePasswordFromEmailResponder $responder,
        ChangePasswordFromEmailHandler $handler,
        $token
    );
}