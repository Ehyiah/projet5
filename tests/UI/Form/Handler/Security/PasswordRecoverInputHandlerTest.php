<?php

namespace App\Tests\UI\Form\Handler\Security;


use App\Domain\DTO\Security\AddUserDTO;
use App\Domain\DTO\Security\PasswordRecoverInputDTO;
use App\Entity\User;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\Handler\Security\PasswordRecoverInputHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

/**
 * Class PasswordRecoverInputHandlerTest
 * @group Handler
 */
final class PasswordRecoverInputHandlerTest extends TestCase
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository = null;

    /**
     * @var Environment
     */
    private $twig = null;

    /**
     * @var \Swift_Mailer
     */
    private $mail = null;

    /**
     * @var TokenStorageInterface
     */
    private $security = null;

    protected function setUp()
    {
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
        $this->twig = $this->createMock(Environment::class);
        $this->mail = $this->createMock(\Swift_Mailer::class);
        $this->security = $this->createMock(TokenStorageInterface::class);
    }

    public function testItImplements()
    {
        $handler = new PasswordRecoverInputHandler(
            $this->userRepository,
            $this->twig,
            $this->mail
        );

        static::assertInstanceOf(
            PasswordRecoverInputHandler::class,
            $handler
        );
    }


    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Exception
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testGoodHandling()
    {
        $handler = new PasswordRecoverInputHandler(
            $this->userRepository,
            $this->twig,
            $this->mail
        );

        $addUserDTO = new AddUserDTO(
            'name', 'password', 'mail@mail.fr'
        );
        $user = new User($addUserDTO);
        $this->security->method('getToken')->willReturn($user);
        $this->userRepository->method('findByName')->willReturn($user);

        $userNameDTO = new PasswordRecoverInputDTO('name');

        $form = $this->createMock(FormInterface::class);
        $form->method('isValid')->willReturn(true);
        $form->method('isSubmitted')->willReturn(true);
        $form->method('getData')->willReturn($userNameDTO);

        static::assertTrue($handler->handle($form));
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Exception
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testBagHandling()
    {
        $handler = new PasswordRecoverInputHandler(
            $this->userRepository,
            $this->twig,
            $this->mail
        );

        $addUserDTO = new AddUserDTO(
            'name', 'password', 'mail@mail.fr'
        );
        $user = new User($addUserDTO);
        $this->security->method('getToken')->willReturn($user);
        $this->userRepository->method('findByName')->willReturn(null);

        $userNameDTO = new PasswordRecoverInputDTO('name');

        $form = $this->createMock(FormInterface::class);
        $form->method('isValid')->willReturn(true);
        $form->method('isSubmitted')->willReturn(true);
        $form->method('getData')->willReturn($userNameDTO);

        static::assertFalse($handler->handle($form));
    }
}
