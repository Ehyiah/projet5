<?php

namespace App\Infra\Doctrine\Repository;


use App\Entity\Comment;
use App\Entity\Interfaces\CommentInterface;
use App\Infra\Doctrine\Repository\Interfaces\CommentRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class CommentRepository extends ServiceEntityRepository implements CommentRepositoryInterface
{
    /**
     * CommentRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function save(CommentInterface $commentRepository) : void
    {
        $this->_em->persist($commentRepository);
        $this->_em->flush();
    }
}