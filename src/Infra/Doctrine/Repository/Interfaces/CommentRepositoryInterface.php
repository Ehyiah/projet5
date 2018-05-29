<?php

namespace App\Infra\Doctrine\Repository\Interfaces;


use App\Entity\Interfaces\CommentInterface;

interface CommentRepositoryInterface
{
    public function save(CommentInterface $comment) : void;
}