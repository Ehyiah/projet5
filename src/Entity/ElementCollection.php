<?php

namespace App\Entity;

use App\Domain\DTO\AddElementCollectionDTO;
use App\Domain\DTO\ElementCollection\EditElementCollectionDTO;
use App\Entity\Interfaces\ElementCollectionInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class ElementCollection
 * @package App\Entity
 */
class ElementCollection implements ElementCollectionInterface
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
    private $region;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $publisher;

    /**
     * @var string
     */
    private $etat;

    /**
     * @var float
     */
    private $buy_price;

    /**
     * @var string
     */
    private $support;

    /**
     * @var integer
     */
    private $player_number;

    /**
     * @var float
     */
    private $value;


    /**
     * relation avec ImageCollection
     * @var ImageCollection
     */
    private $images;

    /**
     * relation avec Collection
     * @var Collection
     */
    private $collection_name;


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
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @return string|null
     */
    public function getPublisher(): ?string
    {
        return $this->publisher;
    }

    /**
     * @return string|null
     */
    public function getEtat(): ?string
    {
        return $this->etat;
    }

    /**
     * @return float|null
     */
    public function getBuyPrice(): ?float
    {
        return $this->buy_price;
    }

    /**
     * @return string|null
     */
    public function getSupport(): ?string
    {
        return $this->support;
    }

    /**
     * @return int|null
     */
    public function getPlayerNumber(): ?int
    {
        return $this->player_number;
    }

    /**
     * @return float|null
     */
    public function getValue(): ?float
    {
        return $this->value;
    }

    /**
     * @return ImageCollection
     * au lieu de ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param ArrayCollection $images
     */
    public function setImages(ArrayCollection $images): void
    {
        $this->images = $images;
    }


    /**
     * @return Collection
     */
    public function getCollectionName(): Collection
    {
        return $this->collection_name;
    }





    /**
     * ElementCollection constructor.
     *
     * @param AddElementCollectionDTO $addElementCollectionDTO
     */
    public function __construct(AddElementCollectionDTO $addElementCollectionDTO)
    {
        $this->id = Uuid::uuid4();
        $this->title = $addElementCollectionDTO->title;
        $this->region = $addElementCollectionDTO->region;
        #$this->author = $author;
        $this->publisher = $addElementCollectionDTO->publisher;
        $this->etat = $addElementCollectionDTO->etat;
        $this->buy_price = $addElementCollectionDTO->buy_price;
        $this->support = $addElementCollectionDTO->support;
        $this->player_number = $addElementCollectionDTO->player_number;
        $this->value = $addElementCollectionDTO->value;
        #$this->collection_name = $collection_name;
        $this->collection_name = $addElementCollectionDTO->collection;

        $this->images = new ArrayCollection();
        $this->addImageToCollection($addElementCollectionDTO->images);
    }

    /**
     * @param array|null $images
     */
    public function addImageToCollection(array $images = null)
    {
        if ($images != null) {
            foreach ($images as $image) {
                $this->images[] = $image;
                $image->setImageElementCollection($this);
            }
        }
    }



    /**
     * @param EditElementCollectionDTO $elementCollectionDTO
     */
    public function editElement(EditElementCollectionDTO $elementCollectionDTO)
    {
        $this->title = $elementCollectionDTO->title;
        $this->region = $elementCollectionDTO->region;
        // $this->author = $elementCollectionDTO->author;
        $this->publisher = $elementCollectionDTO->publisher;
        $this->etat = $elementCollectionDTO->etat;
        $this->buy_price = $elementCollectionDTO->buy_price;
        $this->support = $elementCollectionDTO->support;
        $this->player_number = $elementCollectionDTO->player_number;
        $this->value = $elementCollectionDTO->value;
        $this->images = new ArrayCollection();
        $this->addImageToCollection($elementCollectionDTO->images);
    }
}