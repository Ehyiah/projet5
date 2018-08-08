<?php

namespace App\Controller\Security;


use App\Controller\Security\Interfaces\LoginActionInterface;
use App\UI\Form\Handler\LoginHandler;
use App\UI\Form\Type\User\LoginType;
use App\UI\Responder\LoginResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class LoginAction
 * @package App\Controller
 * @Route("/login", name="login")
 */
class LoginAction implements LoginActionInterface
{
    /**
     * @var EncoderFactoryInterface
     */
    private $encoder;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var LoginHandler
     */
    private $loginHandler;

    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;

    /**
     * LoginAction constructor.
     *
     * @param EncoderFactoryInterface $encoder
     * @param FormFactoryInterface $formFactory
     * @param LoginHandler $loginHandler
     * @param AuthenticationUtils $authenticationUtils
     */
    public function __construct(
        EncoderFactoryInterface $encoder,
        FormFactoryInterface $formFactory,
        LoginHandler $loginHandler,
        AuthenticationUtils $authenticationUtils
    ) {
        $this->encoder = $encoder;
        $this->formFactory = $formFactory;
        $this->loginHandler = $loginHandler;
        $this->authenticationUtils = $authenticationUtils;
    }


    /**
     * @param Request $request
     * @param LoginHandler $loginHandler
     * @param LoginResponder $responder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        LoginHandler $loginHandler,
        LoginResponder $responder
    ) {
        $form = $this->formFactory->create(LoginType::class)
                                    ->handleRequest($request);

        return $responder(false, $form);
    }
}