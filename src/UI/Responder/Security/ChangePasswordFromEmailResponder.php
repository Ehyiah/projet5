<?php

namespace App\UI\Responder\Security;


use App\UI\Responder\Security\Interfaces\ChangePasswordFromEmailResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class ChangePasswordFromEmailResponder
 */
class ChangePasswordFromEmailResponder implements ChangePasswordFromEmailResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * ChangePasswordFromEmailResponder constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
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
            ? $response = new RedirectResponse('home')
            : $response = new Response(
                $this->twig->render('Security/ChangePasswordFromRecovery.html.twig', array(
                    'form' => $form->createView()
                ))
        );

        return $response;
    }
}
