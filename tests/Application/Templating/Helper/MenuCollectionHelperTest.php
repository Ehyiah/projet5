<?php

namespace App\Tests\Application\Templating\Helper;


use App\Application\Templating\Helper\MenuCollectionHelper;
use App\Domain\DTO\Collection\AddCollectionDTO;
use App\Domain\DTO\Security\AddUserDTO;
use App\Entity\Collection;
use App\Entity\User;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Class MenuCollectionHelperTest
 * @group Helper
 */
final class MenuCollectionHelperTest extends TestCase
{
    /**
     * @var TokenStorageInterface
     */
    private $security;

    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * @var TokenInterface
     */
    private $token;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    protected function setUp()
    {
        $this->security = $this->createMock(TokenStorageInterface::class);
        $this->collectionRepository = $this->createMock(CollectionRepositoryInterface::class);
        $this->token = $this->createMock(TokenInterface::class);
        $this->tokenStorage = $this->createMock(TokenStorageInterface::class);
    }

    public function testItImplements()
    {
        $helper = new MenuCollectionHelper(
            $this->security,
            $this->collectionRepository
        );

        static::assertInstanceOf(MenuCollectionHelper::class, $helper);
    }

    /**
     * @throws \Exception
     */
    public function testReturnCollection()
    {
        $helper = $this->createMock(MenuCollectionHelper::class);

        $addCollectionDTO = $this->createMock(AddCollectionDTO::class);
        $collection = new Collection($addCollectionDTO);
        $collectionTab = [$collection, $collection];
        $this->collectionRepository->method('menuFindByOwnerAndCategory')->willReturn($collectionTab);

        $helper->method('menuHelper')->willReturn($collectionTab);

        static::assertContainsOnlyInstancesOf(Collection::class, $collectionTab);
    }
}
