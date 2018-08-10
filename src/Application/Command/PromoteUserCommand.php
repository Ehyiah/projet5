<?php

namespace App\Application\Command;


use App\Application\Command\Interfaces\PromoteUserCommandInterface;
use App\Infra\Doctrine\Repository\UserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PromoteUserCommand extends Command implements PromoteUserCommandInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * PromoteUserCommand constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
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
        ;
        $this
            ->addArgument('Username', InputArgument::REQUIRED, 'Nom de l\'utilisateur à promouvoir')
        ;

    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Changement des droits de l\'utilisateur');

        $username = $input->getArgument('Username');
        $user = $this->userRepository->findByName($username);

        $testROLE = $user->addRoleAdmin();
        if ($testROLE == true) {
            $output->writeln('Cet utilisateur possède déjà le role ADMIN');
            return;
        }


        $this->userRepository->edit($user);

        $output->writeln('Utilisateur promu ADMIN');
    }
}