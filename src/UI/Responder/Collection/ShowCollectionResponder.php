<?php

namespace App\UI\Responder\Collection;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShowCollectionResponder
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ShowCollectionResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param bool $redirect
     * @param FormInterface|null $form
     * @param $collections
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($redirect = false, FormInterface $form = null, $collections)
    {
        $redirect
            ? $response = new Response(
                $this->twig->render('Collection/ShowCollection.html.twig', array(
                    'collections' => $collections
                )))
            : $response = new Response(
                $this->twig->render('Collection/ShowCollectionType.html.twig', array(
                    'form' => $form->createView(),
                    'collection' => $form->getData()
                ))
        );

        return $response;
    }
}