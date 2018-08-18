<?php

namespace App\Controller\Security;


use App\Controller\Security\Interfaces\RegistrationActionInterface;
use App\UI\Form\Type\User\UserType;
use App\UI\Form\Handler\Interfaces\NewUserHandlerInterface;
use App\UI\Responder\Interfaces\RegistrationResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Twig\Environment;

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
     * @var Environment
     */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

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
        Environment $twig,
        UrlGeneratorInterface $urlGenerator,
        NewUserHandlerInterface $handler
    ) {
        $this->encoderFactory = $encoderFactory;
        $this->formFactory = $formFactory;
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
        $this->handler = $handler;
    }


    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        RegistrationResponderInterface $responder
    ) {
        $form = $this->formFactory->create(UserType::class)->handleRequest($request);

        if ($this->handler->handle($form)) {
            $request->getSession()->getFlashBag()->add('success', 'Nouvel utilisateur enregistré');
            return $responder(true);
        }

        return $responder(false, $form);
    }
}
