<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 15/05/2018
 * Time: 09:42
 */

namespace App\Entity;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Comment
 * @package App\Entity
 */
class Comment
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
     * @var date
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
     * @param int $signaled
     * @param date $creation_date
     * @param string $comment_content
     * @param string $collection_name
     * @param string $author
     */
    public function __construct(
        int $signaled,
        date $creation_date,
        string $comment_content,
        string $collection_name,
        string $author
    ) {
        $this->id = Uuid::uuid4();
        $this->creation_date = new \DateTime('now');
        $this->comment_content = $comment_content;
        $this->collection_name = $collection_name;
        $this->author = $author;
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