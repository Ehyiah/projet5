<?php

namespace App\UI\Responder\Collection;


use App\UI\Responder\Collection\Interfaces\ShowCollectionDetailledResponderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class ShowCollectionDetailledResponder
 */
final class ShowCollectionDetailledResponder implements ShowCollectionDetailledResponderInterface
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
     * ShowCollectionDetailledResponder constructor.
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
        $collection = null
    ) {
        $redirect
            ? $response = new RedirectResponse(
                $this->urlGenerator->generate('addElement', array(
                    'id' => $this->session->get('id')
                ))
        )
            : $response = new Response(
                $this->twig->render('Collection/ShowDetailledCollection.html.twig', array(
                    'collection' => $collection
                ))
        );

        return $response;
    }
}
