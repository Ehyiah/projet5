<?php

namespace App\UI\Responder\ElementCollection;


use App\UI\Responder\ElementCollection\Interfaces\EditElementCollectionResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class EditElementCollectionResponder
 */
final class EditElementCollectionResponder implements EditElementCollectionResponderInterface
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
     * @var SessionInterface
     */
    private $session;

    /**
     * EditElementCollectionResponder constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $urlGenerator,
        SessionInterface $session
    )  {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
        $this->session = $session;
    }


    /**
     * {@inheritdoc}
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        $redirect = false,
        FormInterface $form = null
    ) {
        $redirect
            ? $response = new RedirectResponse(
                $this->urlGenerator->generate('editElementCollection', array(
                    'id' => $this->session->get('idElement')
                ))
            )
            : $response = new Response(
                $this->twig->render('ElementCollection/EditElementCollection.html.twig', array(
                    'form' => $form->createView()
                ))
        );

        return $response;
    }
}
