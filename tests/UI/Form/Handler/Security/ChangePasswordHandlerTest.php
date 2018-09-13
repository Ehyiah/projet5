<?php

namespace App\Tests\UI\Form\Handler\Security;


use App\Domain\DTO\Security\AddUserDTO;
use App\Domain\DTO\Security\ChangePasswordDTO;
use App\Entity\User;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\Handler\Security\ChangePasswordHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class ChangePasswordHandlerTest
 * @group Handler1
 */
final class ChangePasswordHandlerTest extends TestCase
{
    /**
     * @var TokenStorageInterface
     */
    private $security = null;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository = null;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory = null;

    protected function setUp()
    {
        $this->security = $this->createMock(TokenStorageInterface::class);
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
        $this->encoderFactory = $this->createMock(EncoderFactoryInterface::class);
    }

    public function testItImplements()
    {
        $handler = new ChangePasswordHandler(
            $this->security,
            $this->userRepository,
            $this->encoderFactory
        );

        static::assertInstanceOf(
            ChangePasswordHandler::class,
            $handler
        );
    }

    /**
     * @throws \Exception
     */
    public function testGoodHandling()
    {
        $handler = new ChangePasswordHandler(
            $this->security,
            $this->userRepository,
            $this->encoderFactory
        );

        $addUserDTO = new AddUserDTO(
            'nom', 'pass', 'mail@mail.fr'
        );
        $user = new User($addUserDTO);

        $dto = new ChangePasswordDTO('pass0', 'pass');

        $this->security->expects($this->once())
            ->method('getToken')
            ->willReturn($user)
        ;

        $this->encoderFactory->method('getEncoder')->willReturn(User::class);



        $form = $this->createMock(FormInterface::class);
        $form->method('getData')->willReturn($dto);
        $form->method('isValid')->willReturn(true);
        $form->method('isSubmitted')->willReturn(true);

        static::assertTrue($handler->handle($form));

    }
}
