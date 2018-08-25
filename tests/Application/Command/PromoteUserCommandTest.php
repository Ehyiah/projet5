<?php

declare(strict_types=1);

namespace App\Tests\Application\Command;

use App\Application\Command\PromoteUserCommand;
use App\Domain\DTO\Security\AddUserDTO;
use App\Entity\User;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class PromoteUserCommandTest.
 * @group Command
 */
final class PromoteUserCommandTest extends KernelTestCase
{
    /**
     * @var UserRepositoryInterface|null
     */
    private $userRepository = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
    }

    /**
     * @param string $username
     * @param string $password
     * @param string $email
     *
     * @throws \Exception
     *
     * @dataProvider provideUserCredentials
     */
    public function testExecute(string $username, string $password, string $email)
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $userDTO = new AddUserDTO($username, $password, $email);
        $user = new User($userDTO);

        $this->userRepository->method('findByName')->willReturn($user);

        $application->add(new PromoteUserCommand($this->userRepository));

        $command = $application->find('promoteUser');

        $commandTester = new CommandTester($command);

        $commandTester->execute(array(
            'command' => $command->getName(),
            'Username' => $user->getUsername()
        ));

        static::assertContains('Utilisateur promu ADMIN', $commandTester->getDisplay());
        static::assertContains('ROLE_ADMIN', $user->getRoles());
    }

    /**
     * @return \Generator
     */
    public function provideUserCredentials()
    {
        yield array('test', 'testUser', 'user@gmail.com');
        yield array('test1', 'testUser1', 'user1@gmail.com');
        yield array('test2', 'testUser2', 'user2@gmail.com');
        yield array('test3', 'testUser3', 'user3@gmail.com');
    }
}
