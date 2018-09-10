<?php

namespace App\Controller\Security\Interfaces;


use App\UI\Form\Handler\Security\Interfaces\ChangeEmailHandlerInterface;
use App\UI\Responder\Security\Interfaces\ChangeEmailResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface ChangeEmailActionInterface
{
    /**
     * ChangeEmailActionInterface constructor.
     *
     * @param ChangeEmailHandlerInterface $handler
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(
        ChangeEmailHandlerInterface $handler,
        FormFactoryInterface $formFactory
    );

    /**
     * @param Request $request
     * @param ChangeEmailResponderInterface $responder
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        ChangeEmailResponderInterface $responder
    );
}
