<?php

namespace App\Controller\Security;


use App\Controller\Security\Interfaces\RecoveryPasswordActionInterface;
use App\UI\Form\Handler\Security\Interfaces\PasswordRecoverInputHandlerInterface;
use App\UI\Form\Type\Security\PasswordRecoverInputType;
use App\UI\Responder\Security\Interfaces\PasswordRecoverInputResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RecoveryPasswordAction
 * @Route("/recoverPassword", name="recoverPassword")
 */
class RecoveryPasswordAction implements RecoveryPasswordActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var PasswordRecoverInputHandlerInterface
     */
    private $handler;

    /**
     * RecoveryPasswordAction constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        PasswordRecoverInputHandlerInterface $handler
    ) {
        $this->formFactory = $formFactory;
        $this->handler = $handler;
    }


    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        PasswordRecoverInputResponderInterface $responder
    ) {
        $form = $this->formFactory->create(PasswordRecoverInputType::class)
                                    ->handleRequest($request);

        if ($this->handler->handle($form)) {
            $request->getSession()->getFlashBag()->add('success', 'Un mail contenant un lien de réinitilisation vous a été envoyé à l\'adresse renseignée lors de la création du compte');
            return $responder(true);
        }

        return $responder(false, $form);
    }
}
