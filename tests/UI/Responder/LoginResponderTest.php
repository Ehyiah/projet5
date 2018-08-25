<?php

namespace App\Tests\UI\Responder;


use App\UI\Responder\LoginResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class LoginResponderTest
 * @group Responder
 */
final class LoginResponderTest extends TestCase
{
    /**
     * @var LoginResponder
     */
    private $responder = null;

    /**
     * @var Environment
     */
    private $twig = null;


    protected function setUp()
    {
        $this->twig = $this->createMock(Environment::class);
        $this->responder = new LoginResponder(
            $this->twig
        );
    }

    public function testItImplements()
    {
        $response = new LoginResponder($this->twig);

        static::assertInstanceOf(
            LoginResponder::class,
            $response
        );
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
