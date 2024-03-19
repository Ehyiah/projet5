<?php

namespace App\Repository;


use App\Entity\Comment;
use App\Entity\Interfaces\CommentInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CommentRepository extends ServiceEntityRepository
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
