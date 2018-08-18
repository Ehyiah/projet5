<?php

namespace App\UI\Responder;


use App\UI\Responder\Interfaces\RegistrationResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class RegistrationResponder
 */
final class RegistrationResponder implements RegistrationResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * RegistrationResponder constructor.
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
