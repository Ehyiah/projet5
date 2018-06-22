<?php

namespace App\Entity;


use App\Domain\DTO\AddCollectionDTO;
use App\Entity\Interfaces\CollectionInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;


/**
 * Class Collection
 * @package App\Entity
 */
class Collection implements CollectionInterface
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
     * @var \DateTime
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
     * @var \DateTime
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
     *
     * @var CategoryCollection
     */
    private $category;

    /**
     * relation avec ImageCollection
     *
     * @var ImageCollection
     *
     */
    private $image;


    /**
     * Collection constructor.
     *
     * @param AddCollectionDTO $addCollectionDTO
     */
    public function __construct(AddCollectionDTO $addCollectionDTO)
    {
        $this->id = Uuid::uuid4();
        $this->collection_name = $addCollectionDTO->name;
        $this->creation_date = new \DateTime();
        $this->tag = $addCollectionDTO->tag;
        $this->category = $addCollectionDTO->category;
        $this->hidden = $addCollectionDTO->visibility;

        $this->image = $addCollectionDTO->image;

        $this->elements_collection = new ArrayCollection();
        $this->collection_comments = new ArrayCollection();
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
    public function getCollectionName(): string
    {
        return $this->collection_name;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime
    {
        return $this->creation_date;
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * @return int
     */
    public function getHidden(): int
    {
        return $this->hidden;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateDate(): \DateTime
    {
        return $this->update_date;
    }

    /**
     * @return mixed
     */
    public function getElementsCollection()
    {
        return $this->elements_collection;
    }

    /**
     * @return mixed
     */
    public function getCollectionComments()
    {
        return $this->collection_comments;
    }

    /**
     * @return CategoryCollection
     */
    public function getCategory(): CategoryCollection
    {
        return $this->category;
    }

    /**
     * @return ImageCollection
     */
    public function getImage(): ImageCollection
    {
        return $this->image;
    }


    /**
     * @return User
     */
    public function getOwner(): User
    {
        return $this->owner;
    }


    /**
     * @param string $collection_name
     * @param string $tag
     * @param string $category
     * @param integer $hidden
     */
    public function edit(
        string $collection_name,
        string $tag,
        string $category,
        int $hidden
    ){
        $this->update_date = new \DateTime('now');
        $this->collection_name = $collection_name;
        $this->tag = $tag;
        $this->category = $category;
        $this->hidden = $hidden;
    }


    /**
     * @param $itemToEdit
     * @param string $content
     */
    public function editOne(
        $itemToEdit,
        string $content
    ){
        $this->$itemToEdit = $content;
        $this->update_date = new \DateTime('now');
    }
}