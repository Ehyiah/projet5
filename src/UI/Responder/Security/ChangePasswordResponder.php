<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 20/07/2018
 * Time: 17:07
 */

namespace App\UI\Responder\Security;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ChangePasswordResponder
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
            ? $response = new RedirectResponse('home')
            : $response = new Response(
                $this->twig->render('Security/ChangePassword.html.twig', array(
                    'form' => $form->createView()
                ))
        );

        return $response;
    }
}