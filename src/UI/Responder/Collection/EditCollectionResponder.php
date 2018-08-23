<?php

namespace App\UI\Responder\Collection;


use App\UI\Responder\Collection\Interfaces\EditCollectionResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class EditCollectionResponder
 */
class EditCollectionResponder implements EditCollectionResponderInterface
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
     * EditCollectionResponder constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $urlGenerator,
        SessionInterface $session
    ) {
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
                $this->urlGenerator->generate('editCollection', array(
                    'id' => $this->session->get('idCollection')
                ))
            )
            : $response = new Response(
                $this->twig->render('Collection\EditCollection.html.twig', array(
                    'form' => $form->createView(),
                ))
        );

        return $response;
    }
}
