<?php

namespace App\Tests\Infra\Doctrine\Repository;


use App\Entity\User;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class UserRepositoryTest
 * @group Repository
 */
final class UserRepositoryTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $em;

    protected function setUp()
    {
        static::bootKernel();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;
    }

    public function testFindByToken()
    {
        $userMock = $this->createMock(User::class);
        $userRepositoryMock = $this->createMock(UserRepositoryInterface::class);
        $userRepositoryMock->method('findByToken')->willReturn($userMock);

        static::assertInstanceOf(User::class, $userMock);
    }

    public function testFindByName()
    {
        $userMock = $this->createMock(User::class);
        $userRepositoryMock = $this->createMock(UserRepositoryInterface::class);
        $userRepositoryMock->method('findByName')->willReturn($userMock);

        static::assertInstanceOf(User::class, $userMock);
    }

    public function testLoadUserByUsername()
    {
        $userMock = $this->createMock(User::class);
        $userRepositoryMock = $this->createMock(UserRepositoryInterface::class);
        $userRepositoryMock->method('loadUserByUsername')->willReturn($userMock);

        static::assertInstanceOf(User::class, $userMock);
    }
}
