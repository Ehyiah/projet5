<?php

namespace App\Application\Command;


use App\Application\Command\Interfaces\PromoteUserCommandInterface;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PromoteUserCommand
 */
final class PromoteUserCommand extends Command implements PromoteUserCommandInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * {@inheritdoc}
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('promoteUser')
            ->setDescription('Promote a User with ROLE_ADMIN')
            ->setHelp('Cette Commande permet de promouvoir un utilisateur en ADMIN')
            ->addArgument('Username', InputArgument::REQUIRED, 'Nom de l\'utilisateur à promouvoir')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $output->writeln('Changement des droits de l\'utilisateur');

        $user = $this->userRepository->findByName($input->getArgument('Username'));

        if (!$user->addRoleAdmin()) {
            $output->writeln('Cet utilisateur possède déjà le role ADMIN');
            return;
        }

        $this->userRepository->edit($user);

        $output->writeln('Utilisateur promu ADMIN');
    }
}
