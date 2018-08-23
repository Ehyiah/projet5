<?php

namespace App\Tests\UI\Responder\Collection;


use App\UI\Responder\Collection\ShowCollectionResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class ShowCollectionResponderTest
 * @group Responder
 */
final class ShowCollectionResponderTest extends TestCase
{
    /**
     * @var Environment
     */
    private $twig = null;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator = null;

    /**
     * @var ShowCollectionResponder
     */
    private $responder = null;

    protected function setUp()
    {
        $this->twig = $this->createMock(Environment::class);
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $this->responder = new ShowCollectionResponder(
            $this->twig,
            $this->urlGenerator
        );
    }

    public function testItImplements()
    {
        $responder = new ShowCollectionResponder(
            $this->twig,
            $this->urlGenerator
        );

        static::assertInstanceOf(ShowCollectionResponder::class, $responder);
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testRedirectIfTrue()
    {
        $response = $this->responder;

        static::assertInstanceOf(
            RedirectResponse::class,
            $response(true)
        );
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testResponseIfFalse()
    {
        $response = $this->responder;
        $form = $this->createMock(FormInterface::class);

        static::assertInstanceOf(
            Response::class,
            $response(false, $form)
        );
    }
}
