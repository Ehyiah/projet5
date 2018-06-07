<?php

namespace App\Entity;


use App\Domain\DTO\AddElementImageDTO;
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
     * Ajouter une relation pour ajouter une image à une collection
     */



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
     * ImageCollection constructor.
     *
     * @param AddElementImageDTO $addElementCollectionImage
     */
    public function __construct(AddElementImageDTO $addElementCollectionImage)
    {

        $this->id = Uuid::uuid4();
        $this->title = $addElementCollectionImage->title;
        $this->creation_date = new \DateTime('now');


        #traitement de l'image avant déplacement dans le dossier
        #$someNewFilename = 'testName.png';
        #$file = $addElementCollectionImage->image;
        #$dir = getenv('UPLOAD_DIR_IMAGE');
        #$file->move($dir, $someNewFilename);
        #$this->image = $addElementCollectionImage->image;
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