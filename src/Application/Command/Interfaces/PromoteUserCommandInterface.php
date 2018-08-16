<?php

namespace App\Application\Command\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;


interface PromoteUserCommandInterface
{
    /**
     * PromoteUserCommandInterface constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository);
}