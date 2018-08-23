<?php

namespace App\Tests\UI\Responder\Collection;


use App\UI\Responder\Collection\EditCollectionResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class EditCollectionResponderTest
 * @group Responder
 */
final class EditCollectionResponderTest extends TestCase
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
     * @var SessionInterface|null
     */
    private $session = null;

    /**
     * @var EditCollectionResponder|null
     */
    private $responder = null;

    protected function setUp()
    {
        $this->twig = $this->createMock(Environment::class);
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $this->session = $this->createMock(SessionInterface::class);
        $this->responder = new EditCollectionResponder(
            $this->twig,
            $this->urlGenerator,
            $this->session
        );
    }


    public function testItImplements()
    {
        $responder = new EditCollectionResponder(
            $this->twig,
            $this->urlGenerator,
            $this->session
        );

        static::assertInstanceOf(EditCollectionResponder::class, $responder);
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testRedirectIfTrue()
    {
        $response = $this->responder;
        $this->urlGenerator->method('generate')->willReturn('editCollection');

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
