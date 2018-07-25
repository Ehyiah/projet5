<?php

namespace App\UI\Responder;


use App\UI\Responder\Interfaces\RegistrationResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class RegistrationResponder implements RegistrationResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * RegistrationResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param bool $redirect
     * @param FormInterface|null $registrationType
     * @return RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($redirect = false, FormInterface $registrationType = null)
    {
        $redirect
            ? $response = new RedirectResponse('home')
            : $response = new Response(
                $this->twig->render('register.html.twig', array(
                    'form' => $registrationType->createView()
                ))
        );

        return $response;
    }
}