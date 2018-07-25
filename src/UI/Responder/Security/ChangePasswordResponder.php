<?php

namespace App\UI\Responder\Security;


use App\UI\Responder\Security\Interfaces\ChangePasswordResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ChangePasswordResponder implements ChangePasswordResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ChangePasswordResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param bool $redirect
     * @param FormInterface|null $form
     * @return RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($redirect = false, FormInterface $form = null)
    {
        $redirect
            ? $response = new RedirectResponse('member')
            : $response = new Response(
                $this->twig->render('Security/ChangePassword.html.twig', array(
                    'form' => $form->createView()
                ))
        );

        return $response;
    }
}