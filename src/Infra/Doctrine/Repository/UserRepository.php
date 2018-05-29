<?php

namespace App\Infra\Doctrine\Repository;


use App\Entity\User;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(UserInterface $user): void
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }
}