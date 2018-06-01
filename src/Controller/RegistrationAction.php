<?php

namespace App\Controller;


use App\Domain\Builder\Interfaces\UserBuilderInterface;
use App\Form\UserType;
use App\UI\Form\Handler\Interfaces\NewUserHandlerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Twig\Environment;

/**
 * Class RegistrationAction
 * @package App\Controller
 * @Route ("/register")
 */
class RegistrationAction
{
    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @var UserBuilderInterface
     */
    private $userBuilder;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * RegistrationAction constructor.
     *
     * @param EncoderFactoryInterface $encoderFactory
     * @param UserBuilderInterface $userBuilder
     * @param FormFactoryInterface $formFactory
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(EncoderFactoryInterface $encoderFactory, UserBuilderInterface $userBuilder, FormFactoryInterface $formFactory, Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->encoderFactory = $encoderFactory;
        $this->userBuilder = $userBuilder;
        $this->formFactory = $formFactory;
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }


    /**
     * @param Request $request
     * @param NewUserHandlerInterface $userHandler
     * @return RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, NewUserHandlerInterface $userHandler)
    {
        $form = $this->formFactory->create(UserType::class)->handleRequest($request);

        if ($userHandler->handle($form)) {
            return new RedirectResponse($this->urlGenerator->generate('home'));
        }

        return new Response($this->twig->render('register.html.twig', array('form' => $form->createView())));
    }
}