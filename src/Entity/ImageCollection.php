<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 15/05/2018
 * Time: 09:33
 */

namespace App\Entity;


use Ramsey\Uuid\UuidInterface;

/**
 * Class ImageCollection
 * @package App\Entity
 */
class ImageCollection
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var blob
     */
    private $image;

    /**
     * @var date
     */
    private $creation_date;

    /**
     * @var date
     */
    private $update_date;

}