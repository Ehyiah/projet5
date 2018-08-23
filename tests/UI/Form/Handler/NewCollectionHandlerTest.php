<?php

namespace App\Tests\UI\Form\Handler;


use App\Domain\DTO\Collection\AddCollectionDTO;
use App\Domain\DTO\Security\AddUserDTO;
use App\Entity\User;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\Handler\NewCollectionHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Class NewCollectionHandlerTest
 * @group Handler
 */
final class NewCollectionHandlerTest extends TestCase
{
    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var TokenInterface
     */
    private $token;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    protected function setUp()
    {
        $this->collectionRepository = $this->createMock(CollectionRepositoryInterface::class);
        $this->tokenStorage = $this->createMock(TokenStorageInterface::class);
        $this->token = $this->createMock(TokenInterface::class);
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
    }


    public function testItImplements()
    {
        $handler = new NewCollectionHandler(
            $this->collectionRepository,
            $this->tokenStorage
        );

        static::assertInstanceOf(NewCollectionHandler::class, $handler);
    }

    /**
     * @throws \Exception
     */
    public function testGoodHandling()
    {
        $newCollectionDTO = $this->createMock(AddCollectionDTO::class);

        $form = $this->createMock(FormInterface::class);
        $form->method('getData')->willReturn($newCollectionDTO);
        $form->method('isSubmitted')->willReturn(true);
        $form->method('isValid')->willReturn(true);

        $handler = new NewCollectionHandler(
            $this->collectionRepository,
            $this->tokenStorage
        );

        $addUserDTO = new AddUserDTO(
            'nom', 'pass', 'mail@mail.fr'
        );
        $user = new User($addUserDTO);

        $this->tokenStorage->expects($this->once())
            ->method('getToken')
            ->willReturn($user)
        ;


        static::assertTrue($handler->handle($form));
    }
}
