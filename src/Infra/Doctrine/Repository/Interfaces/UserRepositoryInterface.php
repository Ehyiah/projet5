<?php

namespace App\Infra\Doctrine\Repository\Interfaces;


use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

interface UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry);

    public function save(UserInterface $user) : void;

    public function edit(UserInterface $user) :void;

    public function findByToken($token);

    public function findByName($name);

    public function loadUserByUsername($username);
}