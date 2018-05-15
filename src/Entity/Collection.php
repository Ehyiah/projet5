<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 15/05/2018
 * Time: 08:58
 */

namespace App\Entity;


use Ramsey\Uuid\UuidInterface;

/**
 * Class Collection
 * @package App\Entity
 */
class Collection
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $collection_name;

    /**
     * @var date
     */
    private $creation_date;

    /**
     * @var string
     */
    private $tag;

    /**
     * @var integer
     */
    private $hidden;

    /**
     * @var date
     */
    private $update_date;

    /**
     * relation avec ElementCollection
     * @var |ArrayAccess
     */
    private $elements_collection;

    /**
     * relation avec Comment
     * @var |ArrayAccess
     */
    private $collection_comments;

    /**
     * relation avec User
     * @var User
     */
    private $owner;

    /**
     * relation avec CategoryCollection
     * @var CategoryCollection
     */
    private $category;
}