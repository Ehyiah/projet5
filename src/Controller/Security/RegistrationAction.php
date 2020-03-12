<?php

namespace App\Controller\Security;

use App\Controller\Security\Interfaces\RegistrationActionInterface;
use App\UI\Form\Type\User\UserType;
use App\UI\Form\Handler\Interfaces\NewUserHandlerInterface;
use App\UI\Responder\Interfaces\RegistrationResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class RegistrationAction
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
     * @var NewUserHandlerInterface
     */
    private $handler;

    /**
     * RegistrationAction constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        EncoderFactoryInterface $encoderFactory,
        FormFactoryInterface $formFactory,
        NewUserHandlerInterface $handler
    ) {
        $this->encoderFactory = $encoderFactory;
        $this->formFactory = $formFactory;
        $this->handler = $handler;
    }


    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        RegistrationResponderInterface $responder
    ): Response {
        $form = $this->formFactory->create(UserType::class)->handleRequest($request);

        if ($this->handler->handle($form)) {
            $request->getSession()->getFlashBag()->add('success', 'Nouvel utilisateur enregistré');
            return $responder(true);
        }

        return $responder(false, $form);
    }
}
