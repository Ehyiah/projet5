<?php

namespace App\UI\Responder;


use App\UI\Responder\Interfaces\NewCollectionResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class NewCollectionResponder implements NewCollectionResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * NewCollectionResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param bool $redirect
     * @param FormInterface $form
     * @return RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($redirect = false, FormInterface $form =null)
    {
        $redirect
            ? $response = new RedirectResponse('home')
            : $response = new Response(
                $this->twig->render('CreateNewCollection/CreateNewCollection.html.twig', array(
                    'form' => $form->createView()
                ))
        );

        return $response;
    }
}