<?php

namespace App\Controller\Security\Interfaces;


use App\UI\Form\Handler\Security\Interfaces\ChangePasswordHandlerInterface;
use App\UI\Responder\Security\Interfaces\ChangePasswordResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface ChangePasswordActionInterface
{
    /**
     * ChangePasswordActionInterface constructor.
     *
     * @param string|null $oldPassword
     * @param FormFactoryInterface $formFactory
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     * @param ChangePasswordHandlerInterface $handler
     */
    public function __construct(
        string $oldPassword = null,
        FormFactoryInterface $formFactory,
        Environment $twig,
        UrlGeneratorInterface $urlGenerator,
        ChangePasswordHandlerInterface $handler
    ) ;

    /**
     * @param Request $request
     * @param ChangePasswordResponderInterface $responder
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        ChangePasswordResponderInterface $responder
    );
}