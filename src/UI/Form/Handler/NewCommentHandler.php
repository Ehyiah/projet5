<?php

namespace App\UI\Form\Handler;


use App\Entity\Comment;
use App\Infra\Doctrine\Repository\Interfaces\CommentRepositoryInterface;
use App\UI\Form\Handler\Interfaces\NewCommentHandlerInterface;
use Symfony\Component\Form\FormInterface;

class NewCommentHandler implements NewCommentHandlerInterface
{
    /**
     * @var CommentRepositoryInterface
     */
    private $commentRepository;

    /**
     * NewCommentHandler constructor.
     *
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $comment = new Comment($form->getData());
            $this->commentRepository->save($comment);

            return true;
        }

        return false;
    }
}