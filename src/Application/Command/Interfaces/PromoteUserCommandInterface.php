<?php

namespace App\Application\Command\Interfaces;


use App\Infra\Doctrine\Repository\UserRepository;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface PromoteUserCommandInterface
{
    public function __construct(UserRepository $userRepository);
}