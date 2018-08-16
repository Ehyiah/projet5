<?php

namespace App\Infra\Doctrine\Repository\Interfaces;


use App\Entity\Interfaces\UserInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

interface UserRepositoryInterface
{
    /**
     * UserRepositoryInterface constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry);

    /**
     * @param UserInterface $user
     */
    public function save(UserInterface $user): void;

    /**
     * @param UserInterface $user
     */
    public function edit(UserInterface $user): void;

    /**
     * @param $token
     *
     * @return UserInterface|null
     */
    public function findByToken($token): ?UserInterface;

    /**
     * @param string $name
     *
     * @return UserInterface|null
     */
    public function findByName(string $name): ?UserInterface;

    /**
     * @param $username
     *
     * @return UserInterface|null
     */
    public function loadUserByUsername($username): ?UserInterface;
}