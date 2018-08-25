<?php

namespace App\Tests\UI\Responder;


use App\UI\Responder\MemberResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class MemberResponderTest
 * @group Responder
 */
final class MemberResponderTest extends TestCase
{
    /**
     * @var MemberResponder
     */
    private $responder = null;

    /**
     * @var Environment
     */
    private $twig = null;

    protected function setUp()
    {
        $this->twig = $this->createMock(Environment::class);
        $this->responder = new MemberResponder(
            $this->twig
        );
    }

    public function testItImplements()
    {
        $response = new MemberResponder(
            $this->twig
        );

        static::assertInstanceOf(
            MemberResponder::class,
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
            $response(true, [])
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

        static::assertInstanceOf(
            Response::class,
            $response([], [])
        );
    }
}
