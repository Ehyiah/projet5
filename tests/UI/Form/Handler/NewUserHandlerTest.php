<?php

namespace App\Tests\UI\Form\Handler;


use App\Domain\DTO\Security\AddUserDTO;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\Handler\NewUserHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class NewUserHandlerTest
 * @group Handler
 */
final class NewUserHandlerTest extends TestCase
{
    /**
     * @var UserRepositoryInterface|null
     */
    private $userRepository = null;

    /**
     * @var EncoderFactoryInterface|null
     */
    private $encoderFactory = null;

    /**
     * @var ValidatorInterface
     */
    private $validator = null;

    protected function setUp()
    {
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
        $this->encoderFactory = $this->createMock(EncoderFactoryInterface::class);
        $this->validator = $this->createMock(ValidatorInterface::class);

        $encoder = $this->createMock(BCryptPasswordEncoder::class);
        $this->encoderFactory->method('getEncoder')->willReturn($encoder);
        $encoder->method('encodePassword')->willReturn('test');
    }

    public function testItImplements()
    {
        $handler = new NewUserHandler(
            $this->userRepository,
            $this->encoderFactory,
            $this->validator
        );

        static::assertInstanceOf(NewUserHandler::class, $handler);
    }

    /**
     * @throws \Exception
     */
    public function testGoodHandling()
    {
        $handler = new NewUserHandler(
            $this->userRepository,
            $this->encoderFactory,
            $this->validator
        );

        $addUserDTO = new AddUserDTO(
            'nom', 'password', 'mail@mail.com'
        );

        $form = $this->createMock(FormInterface::class);

        $form->method('getData')->willReturn($addUserDTO);
        $form->method('isValid')->willReturn(true);
        $form->method('isSubmitted')->willReturn(true);

        static::assertTrue($handler->handle($form));
    }
}
