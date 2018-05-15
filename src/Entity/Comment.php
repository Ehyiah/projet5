<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 15/05/2018
 * Time: 09:42
 */

namespace App\Entity;
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
     * relation avec Collection
     * @var Collection
     */
    private $collection_name;

    /**
     * relation avec User
     * @var User
     */
    private $author;
}