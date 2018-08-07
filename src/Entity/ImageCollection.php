<?php

namespace App\Entity;


use App\Domain\ValueObject\Interfaces\PictureInterface;
use App\Entity\Interfaces\ImageCollectionInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class ImageCollection
 * @package App\Entity
 */
class ImageCollection implements ImageCollectionInterface
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
     * @var \DateTime
     */
    private $creation_date;

    /**
     * @var \DateTime
     */
    private $update_date;


    /**
     * relation avec ElementCollection
     * @var ElementCollection
     */
    private $image_element_collection;



    /**
     * @param ElementCollection $image_element_collection
     */
    public function setImageElementCollection(ElementCollection $image_element_collection): void
    {
        $this->image_element_collection = $image_element_collection;
    }




    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime
    {
        return $this->creation_date;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateDate(): \DateTime
    {
        return $this->update_date;
    }

    /**
     * @return ElementCollection
     */
    public function getImageElementCollection(): ElementCollection
    {
        return $this->image_element_collection;
    }


    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }




    /**
     * @return $this
     */
    public function getImage()
    {
        return $this;
    }

    /**
     * @param ImageCollection|null $image_element_collection
     */
    public function setImage(ImageCollection $image_element_collection = null): void
    {
        $this->image_element_collection = $image_element_collection;
    }


    /**
     * ImageCollection constructor.
     * @param PictureInterface $picture
     * @throws \Exception
     */
    public function __construct(PictureInterface $picture)
    {
        $this->id = Uuid::uuid4();
        $this->title = $picture->getNewFileName();
        $this->creation_date = new \DateTimeImmutable();
    }



    /**
     * @param string $title
     * @param \DateTime $update_date
     * @param \SplFileInfo $image
     */
    public function edit(
        string $title,
        \DateTime $update_date,
        \SplFileInfo $image
    ){
        $this->title = $title;
        $this->update_date = new \DateTime('now');
        $this->image = $image;
    }
}