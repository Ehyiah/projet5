<?php

namespace App\Controller\Security;


use App\Controller\Security\Interfaces\RegistrationActionInterface;
use App\UI\Form\Type\User\UserType;
use App\UI\Form\Handler\Interfaces\NewUserHandlerInterface;
use App\UI\Responder\RegistrationResponder;
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
 * @Route ("/register", name="register")
 */
class RegistrationAction implements RegistrationActionInterface
{
    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

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
     * @param FormFactoryInterface $formFactory
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        EncoderFactoryInterface $encoderFactory,
        FormFactoryInterface $formFactory,
        Environment $twig,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->encoderFactory = $encoderFactory;
        $this->formFactory = $formFactory;
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }


    /**
     * @param Request $request
     * @param NewUserHandlerInterface $userHandler
     * @param RegistrationResponder $responder
     * @return RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        NewUserHandlerInterface $userHandler,
        RegistrationResponder $responder
    ) {
        $form = $this->formFactory->create(UserType::class)->handleRequest($request);

        if ($userHandler->handle($form)) {
            return $responder(true);
            #return new RedirectResponse($this->urlGenerator->generate('home'));
        }

        return $responder(false, $form);
        # return new Response($this->twig->render('register.html.twig', array('form' => $form->createView())));
    }
}