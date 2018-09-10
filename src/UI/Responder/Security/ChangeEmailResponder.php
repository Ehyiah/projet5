<?php

namespace App\UI\Responder\Security;


use App\UI\Responder\Security\Interfaces\ChangeEmailResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class ChangeEmailResponder
 */
class ChangeEmailResponder implements ChangeEmailResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ChangeEmailResponder constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($redirect = false, FormInterface $form = null)
    {
        $redirect
            ? $response = new RedirectResponse('member')
            : $response = new Response(
                $this->twig->render('Security/ChangeEmail.html.twig', array(
                    'form' => $form->createView()
                ))
        );

        return $response;
    }
}
