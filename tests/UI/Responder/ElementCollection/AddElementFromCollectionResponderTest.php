<?php

namespace App\Tests\UI\Responder\ElementCollection;


use App\UI\Responder\ElementCollection\AddElementFromCollectionResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class AddElementFromCollectionResponderTest
 * @group Responder
 */
final class AddElementFromCollectionResponderTest extends TestCase
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
     * @var SessionInterface
     */
    private $session = null;

    /**
     * @var AddElementFromCollectionResponder
     */
    private $responder = null;

    protected function setUp()
    {
        $this->twig = $this->createMock(Environment::class);
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $this->session = $this->createMock(SessionInterface::class);
        $this->responder = new AddElementFromCollectionResponder(
            $this->twig,
            $this->urlGenerator,
            $this->session
        );
    }

    public function testItImplements()
    {
        $responder = new AddElementFromCollectionResponder(
            $this->twig,
            $this->urlGenerator,
            $this->session
        );

        static::assertInstanceOf(AddElementFromCollectionResponder::class, $responder);
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testRedirectIfTrue()
    {
        $response = $this->responder;
        $this->urlGenerator->method('generate')->willReturn('/showDetailled');

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
