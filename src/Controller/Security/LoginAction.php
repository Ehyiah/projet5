<?php

namespace App\Controller\Security;


use App\Controller\Security\Interfaces\LoginActionInterface;
use App\UI\Form\Handler\Interfaces\LoginHandlerInterface;
use App\UI\Form\Handler\LoginHandler;
use App\UI\Form\Type\User\LoginType;
use App\UI\Responder\Interfaces\LoginResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class LoginAction
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
     * @var LoginHandlerInterface
     */
    private $handler;

    /**
     * LoginAction constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        EncoderFactoryInterface $encoder,
        FormFactoryInterface $formFactory,
        LoginHandler $loginHandler,
        AuthenticationUtils $authenticationUtils,
        LoginHandlerInterface $handler
    ) {
        $this->encoder = $encoder;
        $this->formFactory = $formFactory;
        $this->loginHandler = $loginHandler;
        $this->authenticationUtils = $authenticationUtils;
        $this->handler = $handler;
    }


    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        LoginResponderInterface $responder
    ) {
        $form = $this->formFactory->create(LoginType::class)
                                    ->handleRequest($request);

        return $responder(false, $form);
    }
}