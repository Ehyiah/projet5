<?php

namespace App\Tests\UI\Responder\Category;


use App\UI\Responder\Category\SelectCollectionResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class SelectCollectionResponderTest
 * @group Responder
 */
final class SelectCollectionResponderTest extends TestCase
{
    /**
     * @var Environment|null
     */
    private $twig = null;

    /**
     * @var UrlGeneratorInterface|null
     */
    private $urlGenerator = null;

    /**
     * @var SelectCollectionResponder|null
     */
    private $responder = null;

    protected function setUp()
    {
        $this->twig = $this->createMock(Environment::class);
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $this->responder = new SelectCollectionResponder(
            $this->twig,
            $this->urlGenerator
        );
    }


    public function testItImplements()
    {
        $responder = new SelectCollectionResponder(
            $this->twig,
            $this->urlGenerator
        );

        static::assertInstanceOf(SelectCollectionResponder::class, $responder);
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
