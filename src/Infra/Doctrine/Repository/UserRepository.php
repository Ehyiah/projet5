<?php

namespace App\Infra\Doctrine\Repository;


use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRepository extends ServiceEntityRepository implements UserLoaderInterface
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
     * @param $token
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByToken($token)
    {
        return $this->createQueryBuilder('u')
            ->where('u.token_reset = :token')
                ->setParameter('token', $token)
            ->getQuery()
            ->getSingleResult();
    }

    /**
     * @param $name
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByName($name)
    {
        return $this->createQueryBuilder('n')
            ->where('n.username = :name')
                ->setParameter('name', $name)
            ->getQuery()
            ->getSingleResult();
    }


    /**
     * @param string $username
     * @return mixed|null|UserInterface
     */
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getResult();
    }
}