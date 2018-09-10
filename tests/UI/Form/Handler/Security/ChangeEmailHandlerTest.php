<?php

namespace App\Tests\UI\Form\Handler\Security;


use App\Domain\DTO\Security\AddUserDTO;
use App\Domain\DTO\Security\ChangeEmailDTO;
use App\Entity\User;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\Handler\Security\ChangeEmailHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class ChangeEmailHandlerTest
 * @group Handler
 */
final class ChangeEmailHandlerTest extends TestCase
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository = null;

    /**
     * @var TokenStorageInterface
     */
    private $security = null;

    protected function setUp()
    {
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
        $this->security = $this->createMock(TokenStorageInterface::class);
    }

    public function testItImplements()
    {
        $handler = new ChangeEmailHandler(
            $this->security,
            $this->userRepository
        );

        static::assertInstanceOf(ChangeEmailHandler::class, $handler);
    }

    /**
     * @throws \Exception
     */
    public function testGoodHandling()
    {
        $handler = new ChangeEmailHandler(
            $this->security,
            $this->userRepository
        );

        $addUserDTO = new AddUserDTO(
            'nom', 'pass', 'mail@mail.fr'
        );
        $user = new User($addUserDTO);

        $this->security->expects($this->once())
            ->method('getToken')
            ->willReturn($user)
        ;

        $dto = new ChangeEmailDTO('test');

        $form = $this->createMock(FormInterface::class);
        $form->method('getData')->willReturn($dto);
        $form->method('isValid')->willReturn(true);
        $form->method('isSubmitted')->willReturn(true);

        static::assertTrue($handler->handle($form));
    }

    public function provideData()
    {
        yield array('email@email.fr');
        yield array('email@email.fr');
        yield array('email1@email.fr');

    }
}
