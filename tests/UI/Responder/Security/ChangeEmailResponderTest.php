<?php

namespace App\Tests\UI\Responder\Security;


use App\UI\Responder\Security\ChangeEmailResponder;
use App\UI\Responder\Security\Interfaces\ChangeEmailResponderInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class ChangeEmailResponderTest
 * @group Responder
 */
final class ChangeEmailResponderTest extends TestCase
{
    /**
     * @var Environment
     */
    private $twig = null;

    /**
     * @var ChangeEmailResponderInterface
     */
    private $responder = null;

    protected function setUp()
    {
        $this->twig = $this->createMock(Environment::class);
        $this->responder = new ChangeEmailResponder($this->twig);
    }

    public function testItImplements()
    {
        $responder = new ChangeEmailResponder($this->twig);

        static::assertInstanceOf(ChangeEmailResponder::class, $responder);
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
