<?php

namespace App\Tests\Application\Command;


use App\Application\Command\PromoteUserCommand;
use App\Domain\DTO\AddUserDTO;
use App\Entity\User;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use App\Infra\Doctrine\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;


class PromoteUserCommandTest extends KernelTestCase
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function setUp()
    {
        $this->userRepository = $this->createMock(UserRepository::class);
    }


    public function testExecute()
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);


        $userDTO = new AddUserDTO(
            'TestUser',
            'password',
            'user@gmail.com'
        );

        $user = new User($userDTO);

        $application->add(new PromoteUserCommand($this->userRepository));

        $command = $application->find('promoteUser');

        $commandTester = new CommandTester($command);
        $commandTester->setInputs(array(
            'Username' => $user->getUsername(),
        ));
        $commandTester->execute(array(
            'command' => $command->getName(),
            'Username' => $commandTester->getInput()->getArgument('Username'),
        ));

        $outpout = $commandTester->getDisplay();
        $this->assertContains('Username: TestUser', $outpout);
    }
}