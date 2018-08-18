<?php

namespace App\UI\Responder\Collection;


use App\UI\Responder\Collection\Interfaces\ShowCollectionResponderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class ShowCollectionResponder
 */
final class ShowCollectionResponder implements ShowCollectionResponderInterface
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
     * ShowCollectionResponder constructor.
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
    public function __invoke(
        $redirect = false,
        $collections = null
    ) {
        $redirect
            ? $response = new RedirectResponse(
                $this->urlGenerator->generate('select')
                )
            : $response = new Response(
                $this->twig->render('Collection/ShowCollection.html.twig', array(
                    'collections' => $collections
                ))
        );

        return $response;
    }
}
