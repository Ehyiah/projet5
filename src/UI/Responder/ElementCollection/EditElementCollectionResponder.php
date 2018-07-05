<?php

namespace App\UI\Responder\ElementCollection;


use App\Entity\ElementCollection;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class EditElementCollectionResponder
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
     * EditElementCollectionResponder constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }


    /**
     * @param bool $redirect
     * @param FormInterface|null $form
     * @param ElementCollection|null $element
     * @return RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        $redirect = false,
        FormInterface $form = null,
        ElementCollection $element = null
    ) {
        $redirect
            ? $response = new RedirectResponse(
                $this->urlGenerator->generate('editElementCollection', array(
                    'id' => $_SESSION['idElement']))
        )
            : $response = new Response(
                $this->twig->render('ElementCollection/EditElementCollection.html.twig', array(
                    'element' => $element,
                    'form' => $form->createView()
                ))
        );

        return $response;
    }
}