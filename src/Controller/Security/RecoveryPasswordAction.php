<?php

namespace App\Controller\Security;


use App\UI\Form\Handler\Security\PasswordRecoverInputHandler;
use App\UI\Form\Type\Security\PasswordRecoverInputType;
use App\UI\Responder\Security\PasswordRecoverInputResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RecoveryPasswordAction
 * @package App\Controller\Security
 * @Route("/recoverPassword", name="recoverPassword")
 */
class RecoveryPasswordAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * RecoveryPasswordAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }


    /**
     * @param Request $request
     * @param PasswordRecoverInputResponder $responder
     * @param PasswordRecoverInputHandler $handler
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        PasswordRecoverInputResponder $responder,
        PasswordRecoverInputHandler $handler
    ) {
        $form = $this->formFactory->create(PasswordRecoverInputType::class)
                                    ->handleRequest($request);

        if ($handler->handle($form)) {
            return $responder(true);
        }

        return $responder(false, $form);
    }
}