<?php

namespace App\UI\Responder\Collection;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class ShowCollectionDetailledResponder
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
     * ShowCollectionDetailledResponder constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }


    /**
     * @param bool $redirect
     * @param null $collection
     * @return RedirectResponse|Response
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
                $this->urlGenerator->generate('select')
        )
            : $response = new Response(
                $this->twig->render('Collection/ShowDetailledCollection.html.twig', array(
                    'collection' => $collection
                ))
        );

        return $response;
    }
}