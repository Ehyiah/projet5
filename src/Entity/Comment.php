<?php

namespace App\Entity;

use App\Domain\DTO\AddCommentDTO;
use App\Entity\Interfaces\CommentInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;


/**
 * Class Comment
 * @package App\Entity
 */
class Comment implements CommentInterface
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var integer
     */
    private $signaled;

    /**
     * @var \DateTime
     */
    private $creation_date;

    /**
     * @var string
     */
    private $comment_content;


    /**
     * relation avec Collection
     * @var Collection
     */
    private $collection_name;

    /**
     * relation avec User
     * @var User
     */
    private $author;


    /**
     * Comment constructor.
     *
     * @param AddCommentDTO $addCommentDTO
     */
    public function __construct(AddCommentDTO $addCommentDTO)
    {
        $this->id = Uuid::uuid4();
        $this->creation_date = new \DateTime('now');
        $this->comment_content = $addCommentDTO->comment_content;
        #$this->collection_name = $collection_name;
        #$this->author = $author;
    }

    /**
     * @param string $comment_content
     */
    public function edit(
        string $comment_content
    ){
        $this->comment_content = $comment_content;
    }

    /**
     * @param int $signaled
     */
    public function signalComment(
        int $signaled
    ){
        $this->signaled = $signaled;
    }

}