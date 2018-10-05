<?php

namespace App\Tests\UI\Form\Handler\Security;


use App\Domain\DTO\Security\Interfaces\ChangePasswordFromEmailDTOInterface;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\Handler\Security\ChangePasswordFromEmailHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

/**
 * Class ChangePasswordFromEmailHandlerTest
 * @group Handler
 */
final class ChangePasswordFromEmailHandlerTest extends TestCase
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository = null;

    /**
     * @var TokenStorageInterface
     */
    private $security = null;

    /**
     * @var SessionInterface
     */
    private $session = null;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory = null;

    /**
     * @var Request
     */
    private $request = null;

    protected function setUp()
    {
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
        $this->security = $this->createMock(TokenStorageInterface::class);
        $this->session = $this->createMock(SessionInterface::class);
        $this->encoderFactory = $this->createMock(EncoderFactoryInterface::class);
        $this->request = $this->createMock(Request::class);
    }

    public function testItImplements()
    {
        $handler = new ChangePasswordFromEmailHandler(
            $this->userRepository,
            $this->encoderFactory,
            $this->session
        );

        static::assertInstanceOf(
            ChangePasswordFromEmailHandler::class,
            $handler
        );
    }

    /*
    public function testGoodHandling()
    {
        $handler = new ChangePasswordFromEmailHandler(
            $this->userRepository,
            $this->encoderFactory,
            $this->session
        );



        $form = $this->createMock(FormInterface::class);
        $form->method('getData')->willReturn(ChangePasswordFromEmailDTOInterface::class);
        $form->method('isValid')->willReturn(true);
        $form->method('isSubmitted')->willReturn(true);

        static::assertTrue($handler->handle($form));
    }
    */
}
