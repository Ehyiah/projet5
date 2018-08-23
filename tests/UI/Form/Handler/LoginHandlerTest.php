<?php

namespace App\Tests\UI\Form\Handler;


use App\Domain\DTO\Security\Interfaces\LoginDTOInterface;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\Handler\LoginHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class LoginHandlerTest
 * @group Handler
 */
final class LoginHandlerTest extends TestCase
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    protected function setUp()
    {
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
        $this->encoderFactory = $this->createMock(EncoderFactoryInterface::class);
    }

    public function testItImplements()
    {
        $handler = new LoginHandler(
            $this->userRepository,
            $this->encoderFactory
        );

        static::assertInstanceOf(LoginHandler::class, $handler);
    }

    public function testGoodHandling()
    {
        $handler = new LoginHandler(
            $this->userRepository,
            $this->encoderFactory
        );

        $form = $this->createMock(FormInterface::class);
        $form->method('getData')->willReturn(LoginDTOInterface::class);
        $form->method('isSubmitted')->willReturn(true);
        $form->method('isValid')->willReturn(true);

        static::assertTrue($handler->handle($form));
    }
}
