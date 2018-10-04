<?php

namespace App\Entity;


use App\Domain\DTO\ElementCollection\AddElementCollectionDTO;
use App\Domain\DTO\ElementCollection\EditElementCollectionDTO;
use App\Entity\Interfaces\ElementCollectionInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class ElementCollection
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
     * {@inheritdoc}
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * {@inheritdoc}
     */
    public function getPublisher(): ?string
    {
        return $this->publisher;
    }

    /**
     * {@inheritdoc}
     */
    public function getEtat(): ?string
    {
        return $this->etat;
    }

    /**
     * {@inheritdoc}
     */
    public function getBuyPrice(): ?float
    {
        return $this->buy_price;
    }

    /**
     * {@inheritdoc}
     */
    public function getSupport(): ?string
    {
        return $this->support;
    }

    /**
     * {@inheritdoc}
     */
    public function getPlayerNumber(): ?int
    {
        return $this->player_number;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue(): ?float
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * {@inheritdoc}
     */
    public function setImages(ArrayCollection $images): void
    {
        $this->images = $images;
    }


    /**
     * {@inheritdoc}
     */
    public function getCollectionName(): Collection
    {
        return $this->collection_name;
    }


    /**
     * ElementCollection constructor.
     *
     * @param AddElementCollectionDTO $addElementCollectionDTO
     *
     * @throws \Exception
     */
    public function __construct(AddElementCollectionDTO $addElementCollectionDTO)
    {
        $this->id = Uuid::uuid4();
        $this->title = $addElementCollectionDTO->title;
        $this->region = $addElementCollectionDTO->region;
        $this->author = $addElementCollectionDTO->author;
        $this->publisher = $addElementCollectionDTO->publisher;
        $this->etat = $addElementCollectionDTO->etat;
        $this->buy_price = $addElementCollectionDTO->buy_price;
        $this->support = $addElementCollectionDTO->support;
        $this->player_number = $addElementCollectionDTO->player_number;
        $this->value = $addElementCollectionDTO->value;
        $this->collection_name = $addElementCollectionDTO->collection;

        $this->images = new ArrayCollection();
        $this->addImageToCollection($addElementCollectionDTO->images);
    }

    /**
     * {@inheritdoc}
     */
    public function addImageToCollection(array $images = null)
    {
        if ($images != null) {
            foreach ($images as $image) {
                if ($image->image == null) {
                    return null;
                }
            }
        }

        if ($images != null) {
            foreach ($images as $image) {
                $this->images[] = $image->image;
                $image->image->setImageElementCollection($this);
            }
        }
    }


    /**
     * {@inheritdoc}
     */
    public function editElement(EditElementCollectionDTO $elementCollectionDTO)
    {
        $this->title = $elementCollectionDTO->title;
        $this->region = $elementCollectionDTO->region;
        $this->author = $elementCollectionDTO->author;
        $this->publisher = $elementCollectionDTO->publisher;
        $this->etat = $elementCollectionDTO->etat;
        $this->buy_price = $elementCollectionDTO->buy_price;
        $this->support = $elementCollectionDTO->support;
        $this->player_number = $elementCollectionDTO->player_number;
        $this->value = $elementCollectionDTO->value;

        $this->editImageToCollection($elementCollectionDTO->images);
    }

    /**
     * {@inheritdoc}
     */
    public function editImageToCollection(array $images = null)
    {
        if ($images != null) {
            foreach ($images as $image) {
                if ($image->image == null) {
                    return null;
                }
            }
        }


        if ($images != null) {
            unset($this->images);
            foreach ($images as $image) {
                $this->images[] = $image->image;
                $image->image->setImageElementCollection($this);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeImageFromCollection(ImageCollection $image)
    {
        dump($this->images);

        $this->images->removeElement($image);
    }
}
