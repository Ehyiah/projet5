<?php

namespace App\UI\Responder;


use App\UI\Responder\Interfaces\NewImageCollectionResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class NewImageCollectionResponder
 */
final class NewImageCollectionResponder implements NewImageCollectionResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * NewImageCollectionResponder constructor.
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
            ? $response = new RedirectResponse('home')
            : $response = new Response(
                $this->twig->render('Category/CreateNewCategory.html.twig', array(
                    'form' => $form->createView()
                ))
        );

        return $response;
    }
}
