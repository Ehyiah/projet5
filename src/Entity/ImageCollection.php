<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 15/05/2018
 * Time: 09:33
 */

namespace App\Entity;


use App\Domain\DTO\AddElementImageDTO;
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
     * @var string
     */
    private $image;

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
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
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

        $directory = 'public/upload/CollectionImage';
        $someNewFilename = 'testName.png';


        $file = $addElementCollectionImage->image;
        $file->move($directory, $someNewFilename);
        $this->image = $addElementCollectionImage->image;
    }


    /**
     * @param string $title
     * @param \DateTime $update_date
     * @param blob $image
     */
    public function edit(
        string $title,
        \DateTime $update_date,
        blob $image
    ){
        $this->title = $title;
        $this->update_date = new \DateTime('now');
        $this->image = $image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }




}