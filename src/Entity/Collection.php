<?php

namespace App\Entity;


use App\Domain\DTO\Collection\Interfaces\AddCollectionDTOInterface;
use App\Domain\DTO\Collection\Interfaces\EditCollectionDTOInterface;
use App\Entity\Interfaces\CollectionInterface;
use App\Entity\Interfaces\ElementCollectionInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Collection
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
     * @var ElementCollectionInterface
     */
    private $elements_collection;

    /**
     * relation avec Comment
     * @var |ArrayAccess
     */
    private $collection_comments;

    /**
     * @var User
     */
    private $owner;

    /**
     *
     * @var CategoryCollection
     */
    private $category;

    /**
     *
     * @var ImageCollection
     */
    private $image;


    /**
     * Collection constructor.
     *
     * @param AddCollectionDTOInterface $addCollectionDTO
     *
     * @throws \Exception
     */
    public function __construct(AddCollectionDTOInterface $addCollectionDTO)
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
     * @param User $owner
     */
    public function setOwner(User $owner): void
    {
        $this->owner = $owner;
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
     * @return string|null
     */
    public function getTag(): ?string
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
     * @return ElementCollectionInterface|ArrayCollection
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
     * @return ImageCollection|null
     */
    public function getImage(): ?ImageCollection
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
     * @param EditCollectionDTOInterface $editCollectionDTO
     */
    public function edit(EditCollectionDTOInterface $editCollectionDTO)
    {
        $this->update_date = new \DateTime('now');
        $this->collection_name = $editCollectionDTO->name;
        $this->tag = $editCollectionDTO->tag;
        $this->category = $editCollectionDTO->category;
        $this->hidden = $editCollectionDTO->visibility;
        $this->image = $editCollectionDTO->image;
    }
}
