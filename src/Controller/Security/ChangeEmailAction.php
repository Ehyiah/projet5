<?php

namespace App\Controller\Security;

use App\Controller\Security\Interfaces\ChangeEmailActionInterface;
use App\UI\Form\Handler\Security\Interfaces\ChangeEmailHandlerInterface;
use App\UI\Form\Type\Security\ChangeEmailType;
use App\UI\Responder\Security\Interfaces\ChangeEmailResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ChangeEmailAction
 * @IsGranted("ROLE_USER")
 * @Route("/changeEmail", name="changeEmail")
 */
class ChangeEmailAction implements ChangeEmailActionInterface
{
    /**
     * @var ChangeEmailHandlerInterface
     */
    private $handler;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * ChangeEmailAction constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        ChangeEmailHandlerInterface $handler,
        FormFactoryInterface $formFactory
    ) {
        $this->handler = $handler;
        $this->formFactory = $formFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        ChangeEmailResponderInterface $responder
    ) {
        $form = $this->formFactory->create(ChangeEmailType::class)
                                    ->handleRequest($request);

        if ($this->handler->handle($form)) {
            $request->getSession()->getFlashBag()->add('success', 'L\'email a bien été modifié');
            return $responder(true);
        }

        return $responder(false, $form);
    }
}
