<?php

namespace App\Entity;

use App\Domain\DTO\AddElementCollectionDTO;
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
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getPublisher(): string
    {
        return $this->publisher;
    }

    /**
     * @return string
     */
    public function getEtat(): string
    {
        return $this->etat;
    }

    /**
     * @return float
     */
    public function getBuyPrice(): float
    {
        return $this->buy_price;
    }

    /**
     * @return string
     */
    public function getSupport(): string
    {
        return $this->support;
    }

    /**
     * @return int
     */
    public function getPlayerNumber(): int
    {
        return $this->player_number;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @return ArrayCollection
     */
    public function getImages(): ArrayCollection
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
     * @param string $title
     * @param string $region
     * @param string $author
     * @param string $publisher
     * @param string $etat
     * @param float $buy_price
     * @param string $support
     * @param int $player_number
     * @param float $value
     */
    public function editAllElementCollection(
        string $title,
        string $region,
        string $author,
        string $publisher,
        string $etat,
        float $buy_price,
        string $support,
        int $player_number,
        float $value
    ){
        $this->title = $title;
        $this->region = $region;
        $this->author = $author;
        $this->publisher = $publisher;
        $this->etat = $etat;
        $this->buy_price = $buy_price;
        $this->support = $support;
        $this->player_number = $player_number;
        $this->value = $value;
    }

    /**
     * @param $itemToEdit
     * @param $content
     */
    public function editOneElementCollection($itemToEdit, $content){
        $this->$itemToEdit = $content;
    }

    public function addImageToCollection(array $images)
    {
        foreach ($images as $image) {
            $this->images[] = $image;
            $image->setImageElementCollection($this);
        }
    }
}