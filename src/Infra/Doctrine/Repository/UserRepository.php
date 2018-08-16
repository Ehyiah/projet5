<?php

namespace App\Infra\Doctrine\Repository;


use App\Entity\User;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use App\Entity\Interfaces\UserInterface;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface, UserLoaderInterface
{
    /**
     * UserRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param UserInterface $user
     */
    public function save(UserInterface $user): void
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }

    /**
     * @param UserInterface $user
     */
    public function edit(UserInterface $user) :void
    {
        $this->_em->flush();
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByToken($token): ?UserInterface
    {
        return $this->createQueryBuilder('u')
            ->where('u.token_reset = :token')
                ->setParameter('token', $token)
            ->getQuery()
            ->getSingleResult();
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByName(string $name): ?UserInterface
    {
        return $this->createQueryBuilder('n')
            ->where('n.username = :name')
                ->setParameter('name', $name)
            ->getQuery()
            ->getSingleResult();
    }


    /**
     * {@inheritdoc}
     *
     * @return UserInterface|null
     */
    public function loadUserByUsername($username): ?UserInterface
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getResult();
    }
}