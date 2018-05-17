<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 15/05/2018
 * Time: 09:33
 */

namespace App\Entity;


use Ramsey\Uuid\Uuid;
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



    /**
     * relation avec ElementCollection
     * @var ElementCollection
     */
    private $image_element_collection;


    /**
     * ImageCollection constructor.
     * @param string $title
     * @param blob $image
     * @param date $creation_date
     * @param string $image_element_collection
     */
    public function __construct(
        string $title,
        blob $image,
        date $creation_date,
        string $image_element_collection
    )
    {
        $this->id = Uuid::uuid4();
        $this->title = $title;
        $this->creation_date = new \DateTime('now');
        $this->image = $image;
        $this->image_element_collection = $image_element_collection;
    }

    /**
     * @param string $title
     * @param date $update_time
     * @param blob $image
     */
    public function edit(
        string $title,
        date $update_time,
        blob $image
    ){
        $this->title = $title;
        $this->update_date = new \DateTime('now');
        $this->image = $image;
    }
}